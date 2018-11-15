# Creates new core.Observer object in the database.
#
# Any parameters which MAY have spaces or restricted characters should
# be passed using single quotes-i.e. '$param'
# Usage:
#    python createobserver.py user_id role phone_number locations subcounty
#
# Arguments:
#    user_id The row id of the user record
#    role  The "role" of the observer-must be "vht", "midwife", "admin", "dho", "none"
#    phone_number A valid phone number
#    district The row id of the district or "none"
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

result =  -1L
user = None
observer = None
try:
    user = User.objects.get(id=long(sys.argv[1]))
    observer = Observer()
    observer.user = user
    observer.role = sys.argv[2]
    district = sys.argv[3]
    if(district and district != "none")
        observer.district = District.objects.get(id=district)
    observer.phone_number = sys.argv[4]
    subcounty_id = sys.argv[5]
    if(sys.argv[5] and sys.argv[5] != 'none'):
        subcounty = Subcounty.objects.get(id=long(sys.argv[5]))
        observer.subcounty = subcounty
        district = subcounty.district
        observer.district = district
    observer.save()
    # Set parishes m2m field
    if observer.role == 'midwife':
        observer.parishes = Parish.objects.filter(subcounty__id=observer.subcounty.pk)
        observer.save()
        observer.locations = Location.objects.filter(parish__subcounty__id=subcounty_id)
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
    result = Observer.objects.get(user__id=user.id).id
except Exception as e:
    sys.stderr.write("(dashboard) Error creating  observer. Message:'%s'" % e)
print(result)

