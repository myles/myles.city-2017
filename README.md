# myles.city

This is the source code for [one of my web sites](https://myles.city/). It's written in PHP (I know :grimacing:) and deployed on [NearlyFreeSpeech.NET](https://www.nearlyfreespeech.net/).

## Development

### Setup

* PHP 5+
* Node.js
* Bower
* _(Optional)_ Sass for Ruby

Install Grunt and Bower:

	$ npm install -g grunt-cli bower

Install the Node.js and Bower dependencies:

	$ npm install
	$ bower install

### Usage

To run teh develop web server for testing:

	$ grunt develop

To deploy the website:

	$ grunt deploy
