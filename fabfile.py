import os.path

from fabric import api
from fabric.utils import puts

api.env.hosts = ['bear']
api.env.use_ssh_config = True

api.env.repo = 'git@github.com:myles/myles.city'

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
def setup():
    """
    Setup the deploy server.
    """
    # Make a bunch of the directories.
    api.sudo('mkdir -p {0}'.format(' '.join([api.env.proj_dir,
                                             api.env.logs_dir,
                                             api.env.html_dir,
                                             api.env.venv_dir])))

    # Make sure the directories are writeable by me.
    api.sudo('chown myles:myles {0}'.format(' '.join([api.env.proj_dir,
                                                      api.env.html_dir,
                                                      api.env.venv_dir])))

    # Createh virtual environment.
    api.run('virtualenv {0}'.format(api.env.venv_dir))

    with api.cd(api.env.proj_dir):
        api.run('git clone {0} .'.format(api.env.repo))

    # Install the dependencies.
    with api.cd(api.env.proj_dir):
        api.run('{0} install -r {1}'.format(api.env.venv_pip,
                                            os.path.join(api.env.proj_dir,
                                                         'requirements.txt')))


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
def freeze_site():
    """
    Generate the static website.
    """
    with api.cd(api.env.proj_dir):
        api.run('{0} manage.py freeze {1}'.format(api.env.venv_python,
                                                  api.env.html_dir))


@api.task
def ship_it():
    api.local('git push {0} {1}'.format('origin', 'master'))

    git_status = api.local('git status --porcelain', capture=True)
    
    print(git_status)

    # update_code()
    # pip_upgrade()
    # freeze_site()
    # puts("              |    |    | ")
    # puts("             )_)  )_)  )_) ")
    # puts("            )___))___))___)\ ")
    # puts("           )____)____)_____)\\ ")
    # puts("         _____|____|____|____\\\__ ")
    # puts("---------\                   /--------- ")
    # puts("  ^^^^^ ^^^^^^^^^^^^^^^^^^^^^ ")
    # puts("    ^^^^      ^^^^     ^^^    ^^ ")
    # puts("         ^^^^      ^^^ ")
