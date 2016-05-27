import os

from flask_frozen import Freezer

from city import app

freezer = Freezer(app)

app.config['FREEZER_DESTINATION'] = os.path.join(os.path.dirname(os.path.abspath(__file__)), 'build')

if __name__ == '__main__':
    freezer.freeze()

