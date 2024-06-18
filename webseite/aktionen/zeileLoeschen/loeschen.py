# delete_line.py
import sys

file_path = sys.argv[1]
line_to_delete = int(sys.argv[2])

with open(file_path, 'r') as file:
    lines = file.readlines()

with open(file_path, 'w') as file:
    for i, line in enumerate(lines, 1):
        if i != line_to_delete:
            file.write(line)

