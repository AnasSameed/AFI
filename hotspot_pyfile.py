from flask import Flask, render_template, request, jsonify
import json
import os

app = Flask(__name__)

# Path to the data file
data_file = 'data/hotspots.json'

# Ensure the data directory exists
if not os.path.exists('data'):
    os.makedirs('data')

# Initialize data file if it doesn't exist
if not os.path.exists(data_file):
    with open(data_file, 'w') as file:
        json.dump([], file)

@app.route('/', methods=['GET', 'POST'])
def index():
    if request.method == 'POST':
        # Get form data
        name = request.form['name']
        pincode = request.form['pincode']
        disease = request.form['disease']
        lat = request.form['lat']
        lon = request.form['lon']

        # Create a new hotspot entry
        new_entry = {
            'name': name,
            'pincode': pincode,
            'disease': disease,
            'lat': lat,
            'lon': lon
        }

        # Load existing data
        with open(data_file, 'r') as file:
            data = json.load(file)

        # Add the new entry to the data
        data.append(new_entry)

        # Save the updated data back to the file
        with open(data_file, 'w') as file:
            json.dump(data, file, indent=4)

        return jsonify({'status': 'success', 'message': 'Data saved successfully'})

    return render_template('020924.html')

@app.route('/get_hotspots')
def get_hotspots():
    # Load existing data
    with open(data_file, 'r') as file:
        data = json.load(file)
    return jsonify(data)

if __name__ == '__main__':
    app.run(debug=True)
