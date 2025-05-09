import pandas as pd

# Load data
files = [
    "Screening Psikologi Depresi 2021 & TA.xlsx",
    "Screening Psikologi Depresi 2022.xlsx",
    "Screening Psikologi Depresi 2023.xlsx",
    "Screening Psikologi Depresi 2024.xlsx",
    "Screening Psikologi Kecemasan 2021 & TA.xlsx",
    "Screening Psikologi Kecemasan 2022.xlsx",
    "Screening Psikologi Kecemasan 2023.xlsx",
    "Screening Psikologi Kecemasan 2024.xlsx"
]

mapping = {
    "Sama sekali tidak pernah": 1,
    "Sekali - sekali": 2,
    "Agak sering": 3,
    "Sering": 4
}

df_all = pd.DataFrame()
for file in files:
    df = pd.read_excel(file)
    pertanyaan_cols = [col for col in df.columns if df[col].isin(mapping.keys()).any()]
    for col in pertanyaan_cols:
        df[col] = df[col].map(mapping)
    df_all = pd.concat([df_all, df], ignore_index=True)

# --- CEK 1: Missing Values
print("\n==== CEK MISSING VALUES ====")
missing = df_all.isnull().sum()
print(missing[missing > 0])

# --- CEK 2: Distribusi Jawaban
print("\n==== CEK DISTRIBUSI JAWABAN ====")
for col in pertanyaan_cols:
    print(f"Distribusi kolom '{col}':")
    print(df_all[col].value_counts())
    print("-" * 30)

# --- CEK 3: Konsistensi Label
print("\n==== CEK LABEL 'Keterangan' ====")
print(df_all['Keterangan'].value_counts())

# --- CEK 4: Outlier (Nilai aneh di jawaban)
print("\n==== CEK OUTLIER NILAI ====")
for col in pertanyaan_cols:
    unique_values = df_all[col].dropna().unique()
    if not set(unique_values).issubset({1, 2, 3, 4}):
        print(f"⚠️ Warning: Ada nilai aneh di kolom '{col}': {unique_values}")

# --- CEK 5: Balancing Label
print("\n==== CEK BALANCE LABEL ====")
y_cemas = df_all['Keterangan'].apply(lambda x: 'Cenderung Cemas' if 'cemas' in str(x).lower() else 'Tidak Cemas')
y_depresi = df_all['Keterangan'].apply(lambda x: 'Cenderung Depresi' if 'depresi' in str(x).lower() else 'Tidak Depresi')

print("\nDistribusi Cemas:")
print(y_cemas.value_counts())

print("\nDistribusi Depresi:")
print(y_depresi.value_counts())
