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

from mds.core.models import SMSMessage

result = -1
try:
    tag = sys.argv[1]
    text = sys.argv[2]
    # Try updating first. If not exists create new
    try:
        # Essentially forces a unique constraint on objects created in the dashboard
        obj = SMSMessage.objects.get(tag=tag)
        obj.text=text
        obj.save()
        result = obj.id
    except Exception as e:
        obj = SMSMessage(tag=tag, text=text)
        obj.save()
        obj = SMSMessage.objects.get(tag=tag)
        result = obj.id
except Exception as e:
    result = '%s' % e
    sys.stderr.write("(dashboard) createuser.py Error saving user. Message: %s" % e)
print(result)
