import os
import json

from flask import Flask

from flask_appconfig import HerokuConfig
from flask_bootstrap import Bootstrap

from .frontend import frontend


def create_app(configfile=None):
    app = Flask('city')

    HerokuConfig(app, configfile)
    Bootstrap(app)

    app.register_blueprint(frontend)
    app.config['BOOTSTRAP_SERVE_LOCAL'] = True

    ROOT_DIR = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))

    with open(os.path.join(ROOT_DIR, 'feeds.json'), 'r') as f:
        app.config['FEEDS'] = json.loads(f.read())

    return app


app = create_app()

port = int(os.environ.get("PORT", 5000))
host = str(os.environ.get("HOST", '0.0.0.0'))

if __name__ == "__main__":
    app.run(host=host, port=port, debug=True)
