# Paul Michel

from pygame import *
import sys
from math import *
from random import *

# olivia_johnson_2018.py 5 0 50 12 0.005 0.4 10 1

columns_nb = int(sys.argv[1].replace(',','.'))
column_offset = float(sys.argv[2])
lines_padding = int(sys.argv[3])
angle = int(sys.argv[4])
random_decorative_angle = float(sys.argv[5].replace(',','.'))
random_decorative_radius_min = float(sys.argv[6].replace(',','.'))
random_y_decorative_offset = int(sys.argv[7])
random_colors = int(sys.argv[8])
color1 = sys.argv[8]
color2 = sys.argv[2]
color3 = sys.argv[3]
color4 = sys.argv[4]
color5 = sys.argv[8]
colors = []
angle = pi/angle
largeur = 1200
hauteur = 1200

def width(columns_nb, window):
    width = ceil(window/(columns_nb + 1))
    x = []
    for i in range(1, columns_nb + 1):
        x.append(width * i)
    return x

def hex_to_rgb(hex):
    rgb = []
    for i in (0, 2, 4):
        decimal = int(hex[i:i+2], 16)
        rgb.append(decimal)
    return tuple(rgb)

if not column_offset:
    angle2 = angle
else:
    angle2 = angle + uniform(-column_offset, column_offset)

if random_colors:
    for i in range(5):
        colors.append((randint(0,255), randint(0,255), randint(0,255)))
        print(colors[i])
else:
    for i in range(5):
        conversion = hex_to_rgb(sys.argv[9+i].split('#')[1])
        colors.append(conversion)

clock = time.Clock()
BLACK = (0, 0, 0)
WHITE = (255, 255, 255)

display.set_caption("Figure mathématique")
wn = surface.Surface((largeur, hauteur))

print(width(columns_nb, largeur))

wn.fill(BLACK)
R = 100; teta1 = 0; teta2 = pi; teta3 = 0; teta4 = pi; x0 = 200
for c, x in enumerate(width(columns_nb, largeur)):
    y = 0
    for j in range(150):
        y += lines_padding
        teta1 += angle
        teta2 -= angle2
        teta3 += angle + uniform(-random_decorative_angle, random_decorative_angle)
        teta4 -= angle2 + uniform(-random_decorative_angle, random_decorative_angle)
        x1 = x + R * cos(teta1)
        y1 = y + R * sin(teta1)
        x2 = x - R * cos(teta1)
        y2 = y - R * sin(teta1)
        x3 = x + R * cos(teta2)
        y3 = y + R * sin(teta2)
        x4 = x - R * cos(teta2)
        y4 = y - R * sin(teta2)
        x5 = x + (R - R * (uniform(random_decorative_radius_min, 1))) * cos(teta3)
        y5 = (y + (R - R * (uniform(random_decorative_radius_min, 1))) * sin(teta3)) + uniform(-random_y_decorative_offset, random_y_decorative_offset)
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
image.save(wn,fichier)

# Mettre sur GitHub
# Ajouter le choix du nombre de colonnes entre 1 et 10
# Centrer les colonnes