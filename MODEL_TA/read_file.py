import pandas as pd

# Baca file CSV satu per satu
df_depresi_2021 = pd.read_csv("./Screening Psikologi Depresi 2021 & TA.csv")
df_depresi_2022 = pd.read_csv("Screening Psikologi Depresi 2022.csv")
df_depresi_2023 = pd.read_csv("Screening Psikologi Depresi 2023.csv")
df_depresi_2024 = pd.read_csv("Screening Psikologi Depresi 2024.csv")

df_cemas_2021 = pd.read_csv("Screening Psikologi Kecemasan 2021 & TA.csv")
df_cemas_2022 = pd.read_csv("Screening Psikologi Kecemasan 2022.csv")
df_cemas_2023 = pd.read_csv("Screening Psikologi Kecemasan 2023.csv")
df_cemas_2024 = pd.read_csv("Screening Psikologi Kecemasan 2024.csv")


# Tampilkan informasi masing-masing
files_info = {
    "Depresi 2021": {
        "columns": df_depresi_2021.columns.tolist(),
        "head": df_depresi_2021.head()
    },
    "Depresi 2022": {
        "columns": df_depresi_2022.columns.tolist(),
        "head": df_depresi_2022.head()
    },
    "Depresi 2023": {
        "columns": df_depresi_2023.columns.tolist(),
        "head": df_depresi_2023.head()
    },
    "Depresi 2024": {
        "columns": df_depresi_2024.columns.tolist(),
        "head": df_depresi_2024.head()
    },
    "Cemas 2021": {
        "columns": df_cemas_2021.columns.tolist(),
        "head": df_cemas_2021.head()
    },
    "Cemas 2022": {
        "columns": df_cemas_2022.columns.tolist(),
        "head": df_cemas_2022.head()
    },
    "Cemas 2023": {
        "columns": df_cemas_2023.columns.tolist(),
        "head": df_cemas_2023.head()
    },
    "Cemas 2024": {
        "columns": df_cemas_2024.columns.tolist(),
        "head": df_cemas_2024.head()
    }
}

# Print semua informasi file
for file_name, info in files_info.items():
    print(f"=== {file_name} ===")
    print("Columns:", info["columns"])
    print("Head:\n", info["head"])
    print("\n\n")
