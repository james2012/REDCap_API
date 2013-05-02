#!/usr/bin/env python

import sys
import urllib
import httplib

# example usage: ./export_records.py token=<token> content=record format=xml

# Set the url and path to the API
host = 'https://YOUR_REDCAP_INSTALLATION'
path = '/api/'

def main():
   params = {}
   for arg in sys.argv[1:]:
       k, v = arg.split('=')
       params[k] = v

   c = httplib.HTTPSConnection(host)
   c.request('POST', path, urllib.urlencode(params), {'Content-Type': 'application/x-www-form-urlencoded'})
   r = c.getresponse()
   print r.read()
   c.close()

if __name__ == '__main__':
   main()