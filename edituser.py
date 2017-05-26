# Updates auth.User object in the database.
#
# Any parameters which MAY have spaces or restricted characters should
# be passed using single quotes-i.e. '$password'
# Usage:
#    python createuser.py username password [first_name last_name email
#
# Arguments:
#    username The string the user will log in with
#    password The unencrypted password. NOTE if password is not changed pass an empty string ''
# Optional arguments(Shown in brackets above)
#    first_name The user given name
#    last_name The user family name
#    email The user email address
# Returns: The row id of the existing auth.User as a long value-i.e. 2L
#          -1 if the edit was unsuccessful
import sys, os
sys.path.append('/opt/sana/sana.mds')
os.environ['DJANGO_SETTINGS_MODULE'] = 'mds.settings'
from django.conf import settings

from django.contrib.auth.models import User

result = -1
try:
    _id = sys.argv[1]
    user = User.objects.get(id=_id)
    password = sys.argv[2]
    if password:
        user.set_password(password)
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
    result = _id
except:
    pass
print(result)
