from classes.Druides import *
from classes.Habitant import *
from classes.Village import *

lutece = Village("Lutèce") 

asterix = Habitant("Astérix")
obelix = Habitant("Obélix")


lutece.add_habitant(asterix)
lutece.add_habitant(obelix)

print(asterix.village.name)