import sys
import qrcode

# Get input data from command-line arguments
sr_no, name, category, origin_lab = sys.argv[1:]

# Combine data into a single string
data = f"{sr_no}\n{name}\n{category}\n{origin_lab}"

# Generate QR code
qr = qrcode.QRCode(version=1, box_size=10, border=5)
qr.add_data(data)
qr.make(fit=True)
qr_img = qr.make_image(fill_color="black", back_color="white")

# Save QR code with the name of the component
qr_img.save(f"qr_codes/{name}.png")
