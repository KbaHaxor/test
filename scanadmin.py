#!/usr/bin/python
import urllib
import urllib2
import re
siteslist = []
def unique(seq):
   seen = set()
   return [seen.add(x) or x for x in seq if x not in seen]
def checkadmin(site):
    try :
               code = urllib.urlopen(site + "/admin/").getcode()
               if code == 200 :
                      rd = urllib2.urlopen(site + "/admin/").read()
                      ch = re.findall('type="password"',rd)
                      nch = re.findall('name="pwd"',rd)
                      if ch :
                            if not nch :
                                  print site + "/admin/"
    except :
          pass
 
def extractserver(ip):
   try:
       page = 0
       while page <= 50:
               bing = "http://www.bing.com/search?q=ip%3A"+ip+"+&count=50&first="+str(page)
               openbing  = urllib2.urlopen(bing)
               readbing = openbing.read()
               findwebs = re.findall('<h2><a href="(.*?)"' , readbing)
               sitess = findwebs
               for i in sitess:
                   siteslist.append(i)
               page = page + 10
   except :
   pass
print "\!/ Server Admin Panel Scanner By Cyb3r_h4ck3r\!/"
print ''
ip = raw_input("Server Ip Adress : ")
extractserver(ip)
print "---------------------------------------------------"
for site in unique(siteslist) :
    checkadmin(site)
print "---------------------------------------------------"
