#app.py

from flask import Flask, request, jsonify #import main Flask class and request object
from flask_cors import CORS, cross_origin
import utils
import json

app = Flask(__name__) #create the Flask app
cors = CORS(app)
app.config['CORS_HEADERS'] = 'Content-Type'

@app.route('/test', methods=['GET', 'POST'])
@cross_origin()
def query_example():
    print(request)
    if (request.method == 'POST'):
        # data = request.get_json(force=True)
        data = request.get_json()
        print('data is ' + format(data))
        # print(type(data['value']))
        utils.send_string(data['value'])
        return 'lion'
    else:
        return 'walrus'

if __name__ == '__main__':
    print('a')
    app.run(debug=True, port=5000) #run app in debug mode on port 5000
