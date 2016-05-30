# myles.city

This is the source code for [The City of Myles](https://myles.city/), a Planet Planet like site for all my web sites. It was [first developed in PHP](https://github.com/myles/myles.city/tree/v1.0.0) and is now written in Python (using Flask).

## Development

### Requirments

* Python 3.5+
* [pip](https://pip.pypa.io/en/stable/)
* [virtualenvwrapper](https://pypi.python.org/pypi/virtualenvwrapper/)
* [Fabric](http://www.fabfile.org/) _(for deployment)_

### Setup

Install virtualenvwrapper:

```
$ mkvirtualenv myles.city-www
(myles.city-www) $
```

The `(myles.city-www)` prefix indicates that a virtual environment called "myles.city-www" is being used. Next, check that you have the correct version of Python:

```
(myles.city-www) $ python --version
Python 3.5.1
(myles.city-www) $ pip --version
pip 8.0.2 from /Users/…/site-packages (python 3.5)
```

Install the project requirements:

```
(myles.city-www) $ pip install --upgrade -r requirements.txt
```

### Usage

To run the development web server:

```
(myles.city-www) $ pip install --upgrade -r requirements.txt
```

## Deploying

Setup a Debian or Ubuntu server for the website:

```
(myles.city-www) $ fab setup
```

Ship the latest version of the webstie:

```
(myles.city-www) $ fab ship_it
```
