# Creates new auth.User object in the database.
#
# Any parameters which MAY have spaces or restricted characters should
# be passed using single quotes-i.e. '$password'
# Usage:
#    python createuser.py username password [first_name last_name email
#
# Arguments:
#    username The string the user will log in with
#    password The unencrypted password
# Optional arguments(Shown in brackets above)
#    first_name The user given name
#    last_name The user family name
#    email The user email address
# Returns: The row id of the new auth.User as a long value-i.e. 2L
#          -1 if the creation was unsuccessful
import sys, os
sys.path.append('/opt/sana/sana.mds')
os.environ['DJANGO_SETTINGS_MODULE'] = 'mds.settings'
from django.conf import settings

from django.contrib.auth.models import User

result = -1
try:
    username=sys.argv[1]
    password =sys.argv[2]
    user = User.objects.create_user(username, password=password)
    # set [optional] fields here
    try:
        user.first_name = sys.argv[3]
    except:
        pass
    try:
        user.last_name = sys.argv[4]
    except:
        pass
    try:
        user.email = sys.argv[5]
    except:
        pass
    user.save()
    result = User.objects.get(username=username).id
except:
    pass
print(result)
