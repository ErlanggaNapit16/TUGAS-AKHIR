import os
import pandas as pd
import numpy as np
from sklearn.model_selection import train_test_split
from sklearn.tree import DecisionTreeClassifier
from sklearn.metrics import accuracy_score
import joblib

# --- Mapping jawaban ke angka ---
mapping_jawaban = {
    'Sama sekali tidak pernah': 1,
    'Sekali-sekali': 2,
    'Agak sering': 3,
    'Sering': 4
}

# --- Fungsi untuk memetakan jawaban ke angka ---
def map_jawaban_to_angka(jawaban):
    return mapping_jawaban.get(jawaban, np.nan)  # Mengembalikan NaN jika jawaban tidak valid

# --- Load Dataset ---
file_paths = [
    './Screening Psikologi Depresi 2021 & TA.xlsx',
    './Screening Psikologi Depresi 2022.xlsx',
    './Screening Psikologi Depresi 2023.xlsx',
    './Screening Psikologi Depresi 2024.xlsx',
    './Screening Psikologi Kecemasan 2021 & TA.xlsx',
    './Screening Psikologi Kecemasan 2022.xlsx',
    './Screening Psikologi Kecemasan 2023.xlsx',
    './Screening Psikologi Kecemasan 2024.xlsx',
]

data_frames = []
read_files = []  # Menyimpan nama file yang berhasil dibaca
for file in file_paths:
    if os.path.exists(file):
        df = pd.read_excel(file)
        data_frames.append(df)
        read_files.append(file)  # Menambahkan nama file ke dalam list
    else:
        print(f'Warning: File {file} tidak ditemukan.')

# Gabung semua data
data = pd.concat(data_frames, ignore_index=True)

# Tampilkan daftar file yang berhasil dibaca
print(f"\nFile yang berhasil dibaca: {read_files}")

# --- Preprocessing ---
data = data.dropna(axis=1, how='all')  # Drop kolom kosong total

# Daftar kolom pertanyaan cemas (yang terbaca)
cemas_cols = [
    'Limbung, Pening atau lemas',
    'Kegelisahan atau gemetar di dalam diri',
    'Jantung berdebar kuat atau amat cepat',
    'Gemetaran',
    'Merasa tegang atau terhimpit',
    'Sakit kepala',
    'Merasa amat ketakutan atau panik',
    'Merasa resah, tidak dapat diam tenang'
]

# Daftar kolom pertanyaan depresi (yang terbaca)
depresi_cols = [
    'Merasa kurang bertenaga, melamban',
    'Mempersalahkan diri sendiri untuk bermacam-macam hal atau berbagai hal',
    'Mudah menangis',
    'Kehilangan minat atau kesenangan seksual (tidak mau berada di antara perempuan atau laki-laki, lawan jenis)',
    'Selera makan terganggu (berkurang)',
    'Sulit tidur atau mudah terbangun/terjaga',
    'Merasa tidak memiliki harapan mengenai masa depan',
    'Merasa kesepian',
    'Merasa sedih',
    'Berpikir untuk mengakhiri hidup Anda',
    'Merasa terperangkap atau terjebak, tidak dapat keluar dari suatu situasi',
    'Terlalu mengkhawatirkan banyak hal',
    'Merasa tidak tertarik atau tidak berminat terhadap segala hal',
    'Merasa bahwa segala sesutu memerlukan usaha keras atau terasa berat',
    'Merasa tidak berharga'
]

# --- Cek kolom yang tersedia ---
available_cols = set(data.columns)

# Hanya ambil kolom yang memang ada
cemas_cols = [col for col in cemas_cols if col in available_cols]
depresi_cols = [col for col in depresi_cols if col in available_cols]

# Menampilkan jumlah kolom pertanyaan yang terbaca
print(f"\nJumlah kolom pertanyaan cemas yang terbaca: {len(cemas_cols)}")
print(f"Jumlah kolom pertanyaan depresi yang terbaca: {len(depresi_cols)}")

# --- Mapping jawaban ke angka ---
X_cemas = data[cemas_cols].applymap(map_jawaban_to_angka)
X_depresi = data[depresi_cols].applymap(map_jawaban_to_angka)

# Target
if 'Keterangan' not in data.columns:
    raise ValueError("Kolom 'Keterangan' tidak ditemukan di data!")

y_cemas = data['Keterangan']
y_depresi = data['Keterangan']

# --- Tangani NaN pada fitur dan target ---
valid_idx_cemas = ~X_cemas.isnull().any(axis=1) & ~y_cemas.isnull()
X_cemas = X_cemas[valid_idx_cemas]
y_cemas = y_cemas[valid_idx_cemas]

valid_idx_depresi = ~X_depresi.isnull().any(axis=1) & ~y_depresi.isnull()
X_depresi = X_depresi[valid_idx_depresi]
y_depresi = y_depresi[valid_idx_depresi]

# --- Train Model Cemas ---
X_train_cemas, X_test_cemas, y_train_cemas, y_test_cemas = train_test_split(X_cemas, y_cemas, test_size=0.2, random_state=42)

model_cemas = DecisionTreeClassifier(
    max_depth=5,
    min_samples_split=10,
    min_samples_leaf=10,
    random_state=42
)
model_cemas.fit(X_train_cemas, y_train_cemas)

y_pred_cemas = model_cemas.predict(X_test_cemas)
akurasi_cemas = accuracy_score(y_test_cemas, y_pred_cemas)

print(f"\nAkurasi Model Cemas: {akurasi_cemas:.2f}")

# --- Train Model Depresi ---
X_train_depresi, X_test_depresi, y_train_depresi, y_test_depresi = train_test_split(X_depresi, y_depresi, test_size=0.2, random_state=42)

model_depresi = DecisionTreeClassifier(
    max_depth=5,
    min_samples_split=10,
    min_samples_leaf=10,
    random_state=42
)
model_depresi.fit(X_train_depresi, y_train_depresi)

y_pred_depresi = model_depresi.predict(X_test_depresi)
akurasi_depresi = accuracy_score(y_test_depresi, y_pred_depresi)

print(f"\nAkurasi Model Depresi: {akurasi_depresi:.2f}")

# --- Simpan model ---
joblib.dump(model_cemas, 'model/model_cemas12.pkl')
joblib.dump(model_depresi, 'model/model_depresi12.pkl')

print("\nModel cemas dan depresi berhasil disimpan ✅")
