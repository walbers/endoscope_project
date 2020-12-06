#virtual checkup project

This repo provides a website, video chat service, and 

The website code is stored in web_stuff/
The video chat code is stored in _
The light code (arduino and go) is stored in light_stuff/


The website code is written for a LAMP stack.
We deployed the video chat code with heroku.
The light code was written for an arduino controlled Mcp4131-103E Digital Potentiometer. The go code runs a local web server on port 5000 where the website code sends post requests to control the brightness of the light.
