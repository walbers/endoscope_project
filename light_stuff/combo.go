package main

import (
    "encoding/json"
    "strings"
    "io/ioutil"
    "fmt"
    "log"
    "net/http"
    "github.com/jacobsa/go-serial/serial"
)


func findArduino() string {
        contents, _ := ioutil.ReadDir("/dev")
        for _, f := range contents {
                if strings.Contains(f.Name(), "tty.usbserial") ||
                        strings.Contains(f.Name(), "ttyUSB") {
                        return "/dev/" + f.Name()
                }
        }
        return ""
}

func sendArduinoCommand(val string) {


    b := []byte(val)
    //fmt.Printf("%s\n", b)
    //return

    options := serial.OpenOptions{
      PortName: findArduino(),
      BaudRate: 9600,
      DataBits: 8,
      StopBits: 1,
      MinimumReadSize: 4,
    }

    // Open the port.
    port, err := serial.Open(options)
    if err != nil {
      log.Fatalf("serial.Open: %v", err)
    }

    // Make sure to close it later.
    defer port.Close()

    // Write 4 bytes to the port.
    //b := []byte{0x30}
    n, err := port.Write(b)
    if err != nil {
      log.Fatalf("port.Write: %v", err)
    }

    fmt.Println("Wrote", n, "bytes.")
}

type req struct {
  id string
  val string
}

func hello(w http.ResponseWriter, r *http.Request) {

    (w).Header().Set("Access-Control-Allow-Origin", "*")
    (w).Header().Set("Access-Control-Allow-Methods", "POST, GET, OPTIONS, PUT, DELETE")
    (w).Header().Set("Access-Control-Allow-Headers", "Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization")


    if r.URL.Path != "/" {
        http.Error(w, "404 not found.", http.StatusNotFound)
        return
    }
    switch r.Method {
    case "GET":
         fmt.Fprintf(w, "Hello!")
    case "POST":
        // Call ParseForm() to parse the raw query and update r.PostForm and r.Form.
	reqBody, err := ioutil.ReadAll(r.Body)
        if err != nil {
		log.Fatal(err)
        }
	var result map[string]interface{}
	json.Unmarshal([]byte(reqBody), &result)

        fmt.Printf("%s\n", result["value"])
        w.Write([]byte("Received a POST request\n"))
	if str, a := result["value"].(string); a {
		sendArduinoCommand(str)
	}
    default:
        fmt.Fprintf(w, "Sorry, only GET and POST methods are supported.")
    }
}


func main() {

//    http.HandleFunc("/hello", func(w http.ResponseWriter, r *http.Request){
//        fmt.Fprintf(w, "Hello!")
//    })

    http.HandleFunc("/", hello)

    fmt.Printf("Starting server at port 5000\n")

    if err := http.ListenAndServe(":5000", nil); err != nil {
        log.Fatal(err)
    }

}


