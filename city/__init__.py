import os

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

    return app


app = create_app()

port = int(os.environ.get("PORT", 5000))
host = str(os.environ.get("HOST", '0.0.0.0'))

if __name__ == "__main__":
    app.run(host=host, port=port, debug=True)
