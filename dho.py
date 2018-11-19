# Creates new core.Observer object in the database with role dho.
#
# DHO records are assumed to be assigned all localities which either
# directly or indirectly have a foreign key relationship to the 
# dho district. 
#
# Any parameters which MAY have spaces or restricted characters should
# be passed using single quotes-i.e. '$param'
# Usage:
#    python dho.py user_id phone_number district
#
# Arguments:
#    user_id The row id of the user record
#    observer_id The row id of the observer record or -1 if new
#    phone_number A valid phone number
#    district The row id of the district or "none"
# Returns: A dict containing
#    id: The row id of the new record as a long value if successful-i.e. 2L
#       or -1 if not.
#    message: empty string if successful or error if not.
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

# Object fields
role = "dho"
subcounty = -1
parish_ids = []
location_ids = []

user = None
observer = None
result =  {}
message = ''

try:
    # Initialize params
    user_id = long(sys.argv[1])
    observer_id = long(sys.argv[2])
    phone_number = sys.argv[3]
    district = long(sys.argv[4])
    
    user = User.objects.get(id=user_id)
    observer = Observer()
    observer.user = user
    observer.role = role
    observer.phone_number = phone_number
    observer.district = District.objects.get(id=district)
    observer.save()
    observer.parishes = Parish.objects.filter(subcounty__district=district)
    observer.save()
    observer.locations = Location.objects.filter(parish__subcounty__district=district)
    observer.save()
    
    observer_id = Observer.objects.get(user__id=user.id).id
    '''
    if(sys.argv[5] and sys.argv[5] != 'none'):
        subcounty = Subcounty.objects.get(id=long(sys.argv[5]))
        observer.subcounty = subcounty
        district = subcounty.district
        observer.district = district
    observer.save()
    # Set parishes m2m field
    if observer.role == 'midwife':
        observer.save()
        observer.save()
    elif observer.role == 'vht':
        if(sys.argv[6] and sys.argv[6] != 'none'):
            parish_ids = [long(x) for x in sys.argv[6].split(",")]
            observer.parishes = Parish.objects.filter(id__in=parish_ids)
        if(sys.argv[7] and sys.argv[7] != 'none'):
            village_ids = [long(x) for x in sys.argv[7].split(",")]
            observer.locations = Location.objects.filter(id__in=village_ids)
        observer.save()
    elif observer.role == 'dho':
        if(district and district != "none"):
            observer.parishes = Parish.objects.filter(subcounty__district__id=district)
            observer.save()
        else:
            pass
    # Set m2m field locations based on parishes
    if observer.role == 'midwife' or observer.role == 'vht':
        #parishes = [x.id for x in observer.parishes.filter(parish__subcounty__district=district) ]
        #observer.locations = Location.objects.filter(parish__id__in=parishes)
        #observer.save()
        pass
    '''
except Exception as e:
    message = "ERROR: {}".format(e)
    sys.stderr.write("(dashboard) Error creating  observer. Message:'%s'" % e)
result = {
    "id": '{}'.format(observer_id).rstrip('L'),
    "message": message
}
print(result['id'])

