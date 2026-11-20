import json

with open('acf-export.json', 'r', encoding='utf-8') as f:
    content = f.read()

# Extract all top-level objects
depth = 0
start = None
objects = []
for i, ch in enumerate(content):
    if ch == '{':
        if depth == 0:
            start = i
        depth += 1
    elif ch == '}':
        depth -= 1
        if depth == 0 and start is not None:
            objects.append(content[start:i+1])
            start = None

print('Found {} top-level objects'.format(len(objects)))

valid = []
for g in objects:
    try:
        obj = json.loads(g)
        key = obj.get('key', 'NO_KEY')
        title = obj.get('title', '?')
        if key.startswith('group_'):
            valid.append(obj)
            print('Valid: key={}, title={}'.format(key, title))
        else:
            print('Skipping: no group_ key')
    except Exception as e:
        print('Invalid JSON: {}'.format(e))

import os
outdir = 'wp-content/acf-json'
os.makedirs(outdir, exist_ok=True)
for obj in valid:
    path = os.path.join(outdir, obj['key'] + '.json')
    with open(path, 'w', encoding='utf-8') as f:
        json.dump(obj, f, indent=4, ensure_ascii=False)
    print('Wrote {}'.format(path))
