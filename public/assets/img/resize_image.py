from PIL import Image

with Image.open('./siteLogicalScheme.jpg') as img:
    width, height = img.size
    new_height = int(1000 * height / width)

    resized_img = img.resize((1000, new_height))

    resized_img.save('./siteLogicalScheme.jpg')
