import requests
from crispy_forms.helper import FormHelper
from crispy_forms.layout import Submit
from django import forms
from django.contrib.auth.forms import UserCreationForm
from django.contrib.auth.models import User
from django.forms.widgets import DateInput
from django.shortcuts import redirect, render

from .models import Complaint, Profile


class ComplaintForm(forms.ModelForm):
    class Meta:
        model=Complaint
        file = forms.ImageField(label=('Attachments'),required=False, widget=forms.FileInput)
        fields=('Subject','Type_of_complaint','Complaint_against','Description','file')
        #file = forms.ImageField(required=False, label="File")
        

class UserProfileform(forms.ModelForm):
    class Meta:
        model=Profile
        fields=('collegename','contactnumber','Branch','type_user')
    

class UserRegisterForm(UserCreationForm):
    first_name = forms.CharField(max_length=30, required=True)
    last_name = forms.CharField(max_length=30, required=True)
    nsu_id=forms.CharField( max_length=10, required=True)
    class Meta:
        model = User
        fields = ('username', 'first_name', 'last_name', 'email', 'password1', 'password2','nsu_id' )
        
    def clean_email(self):
            # Get the email
        email = self.cleaned_data.get('email')

        # Check to see if any users already exist with this email as a username.
        try:
            match = User.objects.get(email=email)
        except User.DoesNotExist:
            # Unable to find a user, this is fine
            return email

        # A user was found with this as a username, raise an error.
        raise forms.ValidationError('This email address is already in use.')

'''class ProfileForm(forms.ModelForm):
    class Meta:
        model = Profile
        fields = ('bio', 'location',)'''
    
class ProfileUpdateForm(forms.ModelForm):
    email =forms.EmailField(widget = forms.TextInput(attrs={'readonly':'readonly'}))
    first_name=forms.CharField( max_length=30, required=True)
    last_name=forms.CharField( max_length=30, required=True)
    

    
    class Meta:
        model = User
        fields = ['username','email','first_name','last_name']
    
    def clean_email(self):
            # Get the email
        username = self.cleaned_data.get('email')

        # Check to see if any users already exist with this email as a username.
        try:
            match = User.objects.exclude(pk=self.instance.pk).get(username=username)
            
            
        except User.DoesNotExist:
            # Unable to find a user, this is fine
            return username

        # A user was found with this as a username, raise an error.
        raise forms.ValidationError('This email address is already in use.')


class UserProfileUpdateform(forms.ModelForm):
    
    collegename =forms.CharField(widget = forms.TextInput(attrs={'readonly':'readonly'}))
    Branch=forms.CharField(widget = forms.TextInput(attrs={'readonly':'readonly'}))

    class Meta:
        model=Profile
        fields=('collegename','contactnumber','Branch')

class statusupdate(forms.ModelForm):
    class Meta:
        model=Complaint
        fields=('status',)  
        help_texts = {
            'status': None,
          
        }      
