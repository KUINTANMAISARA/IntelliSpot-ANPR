from flask import Flask, request, jsonify
import os
import cv2
from matplotlib import pyplot as plt
import numpy as np
import imutils
import easyocr
import re
from werkzeug.utils import secure_filename

app = Flask(__name__)

# Define the upload folder
UPLOAD_FOLDER = 'uploads'
app.config['UPLOAD_FOLDER'] = UPLOAD_FOLDER

# Ensure the upload folder exists
if not os.path.exists(UPLOAD_FOLDER):
    os.makedirs(UPLOAD_FOLDER)

# Define allowed extensions for images
ALLOWED_EXTENSIONS = {'png', 'jpg', 'jpeg', 'gif'}

def allowed_file(filename):
    return '.' in filename and filename.rsplit('.', 1)[1].lower() in ALLOWED_EXTENSIONS

@app.route('/upload', methods=['POST'])
def upload_file():
    # Check if the post request has the file part
    if 'file' not in request.files:
        return jsonify({'error': request.files})

    file = request.files['file']

    # If the user does not select a file, browser may submit an empty part without a filename
    if file.filename == '':
        return jsonify({'error': 'No selected file'})

    # Check if the file has an allowed extension
    if file and allowed_file(file.filename):
        # Save the uploaded file with a secure filename
        filename = secure_filename(file.filename)
        filepath = os.path.join(app.config['UPLOAD_FOLDER'], filename)
        file.save(filepath)
        img = cv2.imread(filepath)
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
        bfilter = cv2.bilateralFilter(gray, 11, 17, 17) #noise reduction
        edged = cv2.Canny(bfilter, 30, 200) #edge detection

        keypoints = cv2.findContours(edged.copy(), cv2.RETR_TREE, cv2.CHAIN_APPROX_SIMPLE)
        contours = imutils.grab_contours(keypoints)
        contours = sorted(contours, key=cv2.contourArea, reverse=True)[:10]

        location = None
        for contour in contours:
            approx = cv2.approxPolyDP(contour, 10, True)
            if len(approx) == 4:
             location = approx
             break

        location

        mask = np.zeros(gray.shape, np.uint8)
        new_image = cv2.drawContours(mask, [location], 0, 255, -1)
        new_image = cv2.bitwise_and(img, img, mask=mask)



        (x,y) = np.where(mask==255)
        (x1,y1) = (np.min(x), np.min(y))
        (x2,y2) = (np.max(x), np.max(y))
        cropped_image = gray[x1:x2+1, y1:y2+1]

        reader = easyocr.Reader(['en'])
        result = reader.readtext(cropped_image)
        result

        text = result[0][-2]
        pattern = r'[^a-zA-Z0-9\s]'  
        result_string = re.sub(pattern, '', text)

        return jsonify({pattern})

    return jsonify({'error': 'Invalid file extension'})

if __name__ == '__main__':
    app.run(debug=True)
