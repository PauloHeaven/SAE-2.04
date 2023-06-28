# Paul Michel
# Reproduction de la figure de 2018 d'Olivia Odom-Johnson

from pygame import *
import sys
from math import *
from random import *

# Paramètres utilisateur passés en arguments
# Par exemple : olivia_johnson_2018.py 5 0 50 12 0.005 0.4 10 1

columns_nb = int(sys.argv[1].replace(',','.')) # Nombre de colonnes
column_offset = float(sys.argv[2]) # Différence d'angle entre les deux tracés d'une colonne
lines_padding = int(sys.argv[3]) # Espacement entre traits
angle = int(sys.argv[4]) # Angle utilisé pour l'inclinaison
random_decorative_angle = float(sys.argv[5].replace(',','.')) # Variation du hasard de l'angle des traits décoratifs
random_decorative_radius_min = float(sys.argv[6].replace(',','.')) # Variation du hasard de la longueur des traits décoratifs
random_y_decorative_offset = int(sys.argv[7]) # Variation du hasard ajouté ou soustrait à leur ordonnée
random_colors = int(sys.argv[8]) 
colors = []
angle = pi/angle
largeur = 1200 # Dimensions de la surface de dessin
hauteur = 1200

def width(columns_nb, window): # Calcul des abscisses des colonnes
    width = ceil(window/(columns_nb + 1)) # Par exemple pour dessiner 3 colonnes, on divise l'écran en 4
    x = []
    for i in range(1, columns_nb + 1):
        x.append(width * i) # Puis on ajoute chaque multiple de la largeur obtenue dans le tableau des abscisses
    return x

def hex_to_rgb(hex): # Conversion de la valeur #000000 en 3 octets
    rgb = []
    for i in (0, 2, 4):
        decimal = int(hex[i:i+2], 16) # Chaque couple de nombres est un octet, que l'on ajoute à un tableau
        rgb.append(decimal)
    return tuple(rgb)

if not column_offset:
    angle2 = angle # Si pas de décalage, les deux angles sont égaux
else:
    angle2 = angle + uniform(-column_offset, column_offset) # Sinon, une valeur aléatoire est ajoutée

if random_colors: # Si les couleurs sont choisies par l'ordinateur
    for i in range(5):
        colors.append((randint(0,255), randint(0,255), randint(0,255))) # Elles sont générées ici
        print(colors[i])
else:
    for i in range(5):
        conversion = hex_to_rgb(sys.argv[9+i].split('#')[1]) # Sinon, on traite les entrées utilisateur
        colors.append(conversion)

clock = time.Clock()
BLACK = (0, 0, 0)
WHITE = (255, 255, 255)

display.set_caption("Figure mathématique")
wn = surface.Surface((largeur, hauteur))

print(width(columns_nb, largeur))

wn.fill(BLACK) # Couleur de l'arrière-plan
R = 100; teta1 = 0; teta2 = pi; teta3 = 0; teta4 = pi; # Définition du rayon et des angles
for c, x in enumerate(width(columns_nb, largeur)): # Boucle qui répartit les colonnes
    y = 0 # À chaque nouvelle colonne, on recommence en haut
    for j in range(150): # Boucle de génération des colonnes
        y += lines_padding # À chaque nouveau trait, on ajoute l'espacement choisi
        teta1 += angle
        teta2 -= angle2
        teta3 += angle + uniform(-random_decorative_angle, random_decorative_angle) # Ajout du hasard aux traits décoratifs
        teta4 -= angle2 + uniform(-random_decorative_angle, random_decorative_angle)
        x1 = x + R * cos(teta1) # Pivot des traits
        y1 = y + R * sin(teta1)
        x2 = x - R * cos(teta1)
        y2 = y - R * sin(teta1)
        x3 = x + R * cos(teta2)
        y3 = y + R * sin(teta2)
        x4 = x - R * cos(teta2)
        y4 = y - R * sin(teta2)
        x5 = x + (R - R * (uniform(random_decorative_radius_min, 1))) * cos(teta3) # Ajout du hasard variable à la longueur des traits décoratifs
        y5 = (y + (R - R * (uniform(random_decorative_radius_min, 1))) * sin(teta3)) + uniform(-random_y_decorative_offset, random_y_decorative_offset) # Ajout du hasard à la hauteur des traits décoratifs
        x6 = x - (R - R * (uniform(random_decorative_radius_min, 1))) * cos(teta3)
        y6 = (y - (R - R * (uniform(random_decorative_radius_min, 1))) * sin(teta3)) + uniform(-random_y_decorative_offset, random_y_decorative_offset)
        x7 = x + (R - R * (uniform(random_decorative_radius_min, 1))) * cos(teta4)
        y7 = (y + (R - R * (uniform(random_decorative_radius_min, 1))) * sin(teta4)) + uniform(-random_y_decorative_offset, random_y_decorative_offset)
        x8 = x - (R - R * (uniform(random_decorative_radius_min, 1))) * cos(teta4)
        y8 = (y - (R - R * (uniform(random_decorative_radius_min, 1))) * sin(teta4)) + uniform(-random_y_decorative_offset, random_y_decorative_offset)
        draw.line(wn, colors[c], (x1, y1), (x2, y2))
        draw.line(wn, colors[c], (x3, y3), (x4, y4))
        draw.line(wn, colors[c], (x5, y5), (x6, y6))
        draw.line(wn, colors[c], (x7, y7), (x8, y8))

fichier='reponse.png'
image.save(wn,fichier) # Enregistrement du fichier