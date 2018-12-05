# -*- coding: iso-8859-15
import sys
import os
from script import procesar_video
 
if len(sys.argv) > 2:
	name = sys.argv[1]
	id = sys.argv[2]
	procesar_video(name, id)

print(sys.argv[1])



