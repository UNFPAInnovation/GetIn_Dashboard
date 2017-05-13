# Updates the password of a new auth.User object in the database.
#
# Any parameters which MAY have spaces or restricted characters should
# be passed using single quotes-i.e. '$password'
# Usage:
#    python edituserpassword.py username password
#
# Arguments:
#    username The string the user will log in with
#    password The unencrypted password
# Returns: The row id of the updated auth.User as a long value-e.g. 2L
#          -1 if the creation was unsuccessful
import sys, os
sys.path.append('/opt/sana/sana.mds')
os.environ['DJANGO_SETTINGS_MODULE'] = 'mds.settings'
from django.conf import settings

from auth.user import User

result = -1
try:
    user = User.objects.get(username=sys.argv[1])
    user.set_password(sys.argv[2])
    user.save()
    result = user.id
except:
    pass
print(result)
