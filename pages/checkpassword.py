# Script to generate encrypted password
# Usage:
#    python checkpassword.py password encoded
#
# Arguments:
#    password The raw password string.
#    encoded The encoded password surrounded by single quotes.
#        The single quotes are necessary to prevent python 
#        misinterpreting the encoded str as multiple arguments 
# Returns: "True" If the password matches the encoded str
#          "False" If they do no match or arguments are missing
import sys, os
sys.path.append('/opt/sana/sana.mds')
os.environ['DJANGO_SETTINGS_MODULE'] = 'mds.settings'
from django.conf import settings
from django.contrib.auth.hashers import check_password

password = None
encoded = None
result = False
try:
    password = sys.argv[1]
    encoded = unicode(sys.argv[2])
    result = check_password(password,encoded)
except:
    pass
print(result)
