# Creates new core.Observer object in the database with 'vht' role
#
# Any parameters which MAY have spaces or restricted characters should
# be passed using single quotes-i.e. '$param'
# Usage:
#    python chew.py user_id observer_id role phone_number district subcounty parish_ids location_ids
#
# Arguments:
#    user_id The row id of the user record
#    observer_id The row id of the Observer object. Use -1 for new
#    phone_number A valid phone number
#    district The row id of the district or "-1"
#    subcounty Long value representing the Subcounty row id
#    parishes Comma separated list of valid long values-i.e. "1L,2L,3L" or "1,2,3"
#    villages Comma separated list of valid long values-i.e. "1L,2L,3L" or "1,2,3"
# Returns: The row id of the new record as a long value-i.e. 2L
#          -1L if the creation was unsuccessful
import sys, os
sys.path.append('/opt/sana/sana.mds')
os.environ['DJANGO_SETTINGS_MODULE'] = 'mds.settings'
from django.conf import settings

from django.contrib.auth.models import User

from mds.core.models import *
# params for this script
user_id = -1
observer_id = -1
phone_number = ''
district = -1
subcounty_id = -1
parish_ids = ''
location_ids = ''

# Object fields
role = "chew"
parishes = []
locations = []

user = None
observer = None
result =  -1L
messages = []

try:
    # Initialize params
    user_id = long(sys.argv[1])
    observer_id = long(sys.argv[2])
    phone_number = sys.argv[3]
    district = long(sys.argv[4])
    subcounty_id = long(sys.argv[5])
    parish_ids = sys.argv[6]
    parishes = parish_ids.split(",")
    location_ids = sys.argv[7]
    locations = location_ids.split(",")
    
    user = User.objects.get(id=user_id)
    #TODO check for existing with observer_id > 0
    observer = None
    observer.user = user
    observer.role = role
    observer.district = District.objects.get(id=district)
    observer.subcounty = Subcounty.objects.get(id=subcounty_id)
    observer.save()
    observer.parishes = Parish.objects.filter(id__in=parishes)
    observer.save()
    observer.locations = Location.objects.filter(id__in=locations)
    observer.save()
    result = Observer.objects.get(user__id=user.id).id
except Exception as e:
    messages.append("%s" % e)
print('{}'.format(result).rstrip('L'))

