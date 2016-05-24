import os.path

from fabric import api
from fabric.utils import puts

api.env.hosts = ['bear']
api.env.use_ssh_config = True

# Directories
api.env.root_dir = '/srv/www/myles.city/www'
api.env.proj_dir = os.path.join(api.env.root_dir, 'app')
api.env.logs_dir = os.path.join(api.env.root_dir, 'logs')
api.env.html_dir = os.path.join(api.env.root_dir, 'html')
api.env.venv_dir = os.path.join(api.env.root_dir, 'venv')

# Python Bullshit
api.env.venv_python = os.path.join(api.env.venv_dir, 'bin/python')
api.env.venv_pip = os.path.join(api.env.venv_dir, 'bin/pip')


@api.task
def python_version():
    """
    Return the Python version on the server for testing.
    """
    with api.cd(api.env.proj_dir):
        api.run("{0} -V".format(api.env.venv_python))


@api.task
def update_code():
    """
    Update to the latest version of the code.
    """
    with api.cd(api.env.proj_dir):
        # TODO `master` and `origin` should be in the environment variables.
        api.run('git reset --hard HEAD')
        api.run('git checkout {0}'.format('master'))
        api.run('git pull {0} {1}'.format('origin', 'master'))


@api.task
def pip_upgrade():
    """
    Upgrade the third party Python libraries.
    """
    with api.cd(api.env.proj_dir):
        api.run('{0} install --upgrade -r '
                'requirements.txt'.format(api.env.venv_pip))


@api.task
def gunicorn_restart():
    """
    Restart the supervisord process.
    """
    # TODO `mylesb.ca-whereis` should be in the environment variables.
    api.sudo('supervisorctl restart {0}'.format('myles.city-www'))


@api.task
def ship_it():
    update_code()
    pip_upgrade()
    gunicorn_restart()
    puts("        />>")
    puts(" __   .' '}")
    puts("{_ \.'  <<")
    puts("  \(  )_/``")
    puts("   ``---``")
