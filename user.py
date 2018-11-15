# Creates new auth.User object in the database.
#
# Any parameters which MAY have spaces or restricted characters should
# be passed using single quotes-i.e. '$password'
# Usage:
#    python user.py user_id username password [first_name last_name email
#
# Arguments:
#    user_id: Row id of the user record or -1 if new
#    username The string the user will log in with
#    password The unencrypted password
# Optional arguments(Shown in brackets above)
#    first_name The user given name
#    last_name The user family name
#    email The user email address
# Returns: The row id of the new auth.User as a long value if successful or
#          -1 if the creation was unsuccessful
import sys, os
sys.path.append('/opt/sana/sana.mds')
os.environ['DJANGO_SETTINGS_MODULE'] = 'mds.settings'
from django.conf import settings

from django.contrib.auth.models import User

result = -1
messages = []
try:
    user_id = long(sys.argv[1])
    username = sys.argv[2]
    password = sys.argv[3]
    user = None
    if user_id > 0:
        user = User.objects.get(id=1)
        # TODO Update fields so this can act as an edit script
    else: 
        user = User.objects.create_user(username, password=password)
    # set [optional] fields here
    try:
        user.first_name = sys.argv[3]
    except Exception as e:
        messages.append("'%s' -> '%s'" % ("first_name", e))
    try:
        user.last_name = sys.argv[4]
    except Exception as e:
        messages.append("'%s' -> '%s'" % ("last_name", e))
    try:
        user.email = sys.argv[5]
    except Exception as e:
        messages.append("'%s' -> '%s'" % ("email", e))
    user.save()
    result = User.objects.get(username=username).id
except Exception as e:
    messages.append("'%s' -> '%s'" % ("email", e))
message = messages.join(":")
print('{}'.format(result).rstrip('L'))
