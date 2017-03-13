class Subject(AbstractSubject): 
    """ Simple subject implementation as a medical patient. 
    """
    class Meta:
        app_label = "core"
    given_name = models.CharField(max_length=64)
    family_name=models.CharField(max_length=64)
    pnumber = models.CharField(max_length=10)
    dob=models.DateTimeField()
    gender=models.CharField(max_length=6)
    holder_pNumber = models.CharField(max_length=10, blank=True)
    LMD = models.DateTimeField()
    marital_status = models.CharField(max_length=64)
    comment = models.TextField()
    location=models.TextField()
    education_level=models.CharField(max_length=60)
    contraceptive_use=models.CharField(max_length=60)
    ANC_status=models.CharField(max_length=60)
    ANC_visit=models.DateTimeField()
    EDD=models.DateTimeField()
    receive_sms=models.CharField(max_length=60)
    follow_up=models.CharField(max_length=60)
    CUG_status=models.CharField(max_length=60)
    bleeding=models.CharField(max_length=60)
    fever=models.CharField(max_length=60)
    swollen_feet=models.CharField(max_length=60)
    blurred_vision=models.CharField(max_length=60)
