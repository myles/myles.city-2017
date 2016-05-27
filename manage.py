#!/usr/bin/env python

import os

from flask_frozen import Freezer
from flask.ext.script import Manager, Shell, Server

from city import app


def create_app(config=None):
    if config is not None:
        app.config.from_pyfile(config)

    return app


manager = Manager(create_app)

manager.add_option('-c', '--config',
                   dest='config',
                   help='config file')

manager.add_command('runserver', Server())
manager.add_command('shell', Shell())

@manager.command
@manager.option('-d', '--dir', help='Directory output.')
def freeze(directory):
    freezer = Freezer(app)

    app.config['FREEZER_DESTINATION'] = directory

    freezer.freeze()

if __name__ == '__main__':
    manager.run()
