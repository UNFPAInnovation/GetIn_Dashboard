# Updates core.AmbulanceDriver object in the database.
#
# Any parameters which MAY have spaces or restricted characters should
# be passed using single quotes-i.e. '$param'
# Usage:
#    python createambulancedriver.py id phone_number first_name last_name subcounty
#
# Arguments:
#    id row id of an existing AmbulanceDriver as a long value
#    phone_number A valid phone number
#    first_name The given name
#    last_name The family name
#    subcounty Long value representing the Subcounty row id
# Returns: The row id of the updated record as a long value-i.e. 2L
#          -1L if the editing was unsuccessful
import sys, os
sys.path.append('/opt/sana/sana.mds')
os.environ['DJANGO_SETTINGS_MODULE'] = 'mds.settings'
from django.conf import settings

from mds.core.models import *

result =  -1L
user = None
obj = None
try:
    _id = long(sys.argv[1])
    obj = AmbulanceDriver.objects.get(id=_id)
    obj.phone_number = sys.argv[2]
    obj.first_name = sys.argv[3]
    obj.last_name = sys.argv[4]
    obj.subcounty = Subcounty.objects.get(id=long(sys.argv[5]))
    obj.save()
    result = obj.pk
except:
    pass
print(result)
