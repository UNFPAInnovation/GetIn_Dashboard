# Script to generate encrypted password
# Usage:
#    python checkpassword.py password
# Arguments: 
#    password The password to encrypt
# Returns: The encrypted password str
# Returns: Empty string if no password provided 
import sys, os
sys.path.append('/opt/sana/sana.mds')
os.environ['DJANGO_SETTINGS_MODULE'] = 'mds.settings'
from django.conf import settings
from django.contrib.auth.hashers import make_password

password = None
result = ""
try:
    password = sys.argv[1]
    result = make_password(password)
except:
    pass
print(result)
