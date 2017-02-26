# first argument:python script file
# second argument: file of year your want to parse
# third argument : file you want to output

import re
import sys
import operator
from operator import itemgetter
args=sys.argv

if(len(args)<2) :
	print ("WHY YOU DONT TYPE IN ANY TEXTFILE NAME, ARE YOU OUT OF YOUR MIND?")
	exit()
try:
	input_file=open(args[1],"r")
except IOError:
	print ("UNVALID input_FILE NAME")
	exit()
getY=re.match('(\w*\-)(\d{4})\.txt$',args[1])
year=getY.group(2)
if(len(args)<3):
	out_put="battingAverage"+year+".txt"
	# averageFile=open("averageFile.txt","w")
else:
	if re.match('\w*\.txt$',args[2]) == None:
		print("UNVALID OUTPUT FILE,PLEASE USE TEXT FILE OR WE WILL USE averageFile.txt as DEFAULT")
		exit()
	else :
		out_put=args[2]

data=input_file.readlines()
input_file.close()
allstates={}
for line in data:
	pat="(?P<FirstName>\w*)\s(?P<LastName>\w*)\sbatted\s(?P<atbats>\d*)\stimes\swith\s(?P<hits>\d*)\shits\sand\s(?P<runs>\d*)\sruns"
	match=re.match(pat,line)
	if match != None:
		fullName=match.group('FirstName')+" "+match.group('LastName')
		atbatsToday=float(match.group('atbats'))
		hitsToday=float(match.group('hits'))
		runsToday=float(match.group('runs'))
		if fullName  not in allstates:
			nowPlayer={'FullName':fullName,'atbats':atbatsToday,'hits':hitsToday,'runs':runsToday}
			allstates[fullName]=nowPlayer
		else:
			allstates[fullName]['atbats']=allstates[fullName]['atbats']+atbatsToday
			allstates[fullName]['hits']=allstates[fullName]['hits']+hitsToday
			allstates[fullName]['runs']=allstates[fullName]['runs']+runsToday
battingAverage=[]
for nowPlayer in allstates:
	avg=allstates[nowPlayer]['hits']/allstates[nowPlayer]['atbats']
	battingAverage.append((nowPlayer,avg))

battingAverage.sort(key=operator.itemgetter(1),reverse=True)
# averageFile=open(output_file,"w")
# print(battingAverage)
averageFile=open(out_put,"w")
for Player in battingAverage:
	toWrite=Player[0]+"  :  "+str(Player[1])[0:5]
	averageFile.write(toWrite)
	averageFile.write('\n')
	# print(toWrite)
averageFile.close()