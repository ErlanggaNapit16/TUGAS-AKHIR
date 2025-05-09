import os
import joblib
import numpy as np
from flask import Flask, request, jsonify

# Inisialisasi Flask
app = Flask(__name__)

# --- Mapping jawaban ke angka ---
mapping_jawaban = {
    'Sama sekali tidak pernah': 1,
    'Sekali-sekali': 2,
    'Agak sering': 3,
    'Sering': 4
}

# Fungsi untuk memetakan jawaban ke angka
def map_jawaban_to_angka(jawaban):
    return mapping_jawaban.get(jawaban, np.nan)  # Mengembalikan NaN jika jawaban tidak valid

# --- Load Model cemas dan depresi (yang terbaru) ---
model_cemas = joblib.load('model/model_cemas12.pkl')
model_depresi = joblib.load('model/model_depresi12.pkl')

@app.route('/predict', methods=['POST'])
def predict():
    data = request.get_json()

    # Cek jika data valid
    if not data or 'cemas' not in data or 'depresi' not in data:
        return jsonify({'error': 'Data cemas dan depresi tidak ditemukan'}), 400

    cemas_input = data['cemas']
    depresi_input = data['depresi']


     # >>> Tambahin print debug disini
    print('Input cemas:', len(cemas_input))
    print('Input depresi:', len(depresi_input))
    print('Model cemas expects:', len(model_cemas.feature_names_in_))
    print('Model depresi expects:', len(model_depresi.feature_names_in_))
    # <<< Sampai sini

    # Cek panjang input
    if len(cemas_input) != len(model_cemas.feature_names_in_) or len(depresi_input) != len(model_depresi.feature_names_in_):
        return jsonify({
            'error': 'Jumlah fitur tidak sesuai',
            'expected_cemas_features': list(model_cemas.feature_names_in_),
            'expected_depresi_features': list(model_depresi.feature_names_in_)
        }), 400

    # Cek jika ada nilai yang bukan angka
    if not all(isinstance(x, (int, float)) for x in cemas_input) or not all(isinstance(x, (int, float)) for x in depresi_input):
        return jsonify({'error': 'Jawaban mengandung nilai yang tidak valid'}), 400

    # Prediksi
    prediksi_cemas = model_cemas.predict([cemas_input])[0]
    prediksi_depresi = model_depresi.predict([depresi_input])[0]

    return jsonify({
        'prediksi_cemas': prediksi_cemas,
        'prediksi_depresi': prediksi_depresi
    })

if __name__ == '__main__':
    app.run(debug=True)
