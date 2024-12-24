# %%
"""
# **Konversi Statistika dan kebijakan**
"""

# %%
"""
## **Import library**
"""

# %%
import pandas as pd
import numpy as np
import seaborn as sns
import matplotlib.pyplot as plt
from sklearn.model_selection import train_test_split
from datetime import datetime, timedelta
from sklearn.preprocessing import StandardScaler
from sklearn.neighbors import KNeighborsClassifier
from sklearn.metrics import classification_report
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import classification_report, accuracy_score

# %%
"""
## **Preporcessing data**
"""

# %%
url='https://drive.google.com/file/d/16RShrtNcnlB8gLWX_EfTlXBoXmHGK7nU/view?usp=drive_link'
url='https://drive.google.com/uc?id=' + url.split('/')[-2]
df = pd.read_csv(url)

# %%
df.head()

# %%
df.info()

# %%
"""
### **Membagi Dataset**
"""

# %%
# Memfilter data untuk lokasi "Tandes"
df_tandes = df[df['Lokasi'] == 'Tandes']

# Menghapus kolom "X" dan "Y"
df_tandes = df_tandes.drop(columns=['X', 'Y'])

# Reset index dan drop kolom nomor jika berasal dari CSV
df_tandes = df_tandes.reset_index(drop=True)

# Membagi data menjadi 80% untuk training dan 20% untuk testing berdasarkan indeks
split_index = int(len(df_tandes) * 0.8)
df_training_tandes = df_tandes.iloc[:split_index]
df_testing_tandes = df_tandes.iloc[split_index:]

# Menampilkan informasi dari kedua dataset
print(f"Data Training: {df_training_tandes.shape}")
print(f"Data Testing : {df_testing_tandes.shape}")


# %%
df_training_tandes.head()

# %%
df_testing_tandes.head()

# %%
# Simpan hasil prediksi ke dalam file Excel tanpa indeks
df_training_tandes.to_excel('Training_udara.xlsx', index=False)

# %%
# Simpan hasil prediksi ke dalam file Excel tanpa indeks
df_testing_tandes.to_excel('Testing_udara.xlsx', index=False)

# %%
df_testing_tandes.info()

# %%
"""

"""

# %%
df_training_tandes.info()

# %%
"""
### **Mengcopy Data set**
"""

# %%
# Memfilter data untuk lokasi "Tandes" dan membuat df_tandes
df_tandes = df_training_tandes[df_training_tandes['Lokasi'] == 'Tandes'].copy()

# Menambahkan kolom "Max" dengan nilai maksimum dari parameter (PM10, PM2.5, SO2, CO, O3, NO2, HC)
parameter_columns = ['PM10', 'PM2.5', 'SO2', 'CO', 'O3', 'NO2', 'HC']
df_tandes['Max'] = df_tandes[parameter_columns].max(axis=1)

# Menambahkan penilaian ISPU berdasarkan nilai "Max"
def ispu_category(value):
    if 1 <= value <= 50:
        return 'Baik'
    elif 51 <= value <= 100:
        return 'Sedang'
    elif 101 <= value <= 150:
        return 'Tidak Sehat'
    elif 151 <= value <= 200:
        return 'Sangat tidak sehat'
    else:
        return 'Berbahaya'

df_tandes['Kategori'] = df_tandes['Max'].apply(ispu_category)

# Membuat df_tandess yang sama dengan df_tandes
df_tandess = df_tandes.copy()

# %%
"""
### **df_tandess**
"""

# %%
# Menampilkan hasil
df_tandes.head()

# %%
# Simpan hasil prediksi ke dalam file Excel tanpa indeks
df_tandess.to_excel('training_Tandes_udara.xlsx', index=False)

# %%
"""
### **df_tandess**
"""

# %%
df_tandess.head()

# %%
df_tandess.info()

# %%
df_tandess.head()

# %%
"""
## **Proses 1 membuat algoritma dengan metode KNN**
"""

# %%
# Pilih variabel independen dan target
X = df_tandes[['PM10', 'PM2.5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]
y = df_tandes['Kategori']

# Membagi data menjadi data latih dan data uji
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.20, random_state=42)

# Normalisasi data
scaler = StandardScaler()
scaler.fit(X_train)
X_train = scaler.transform(X_train)
X_test = scaler.transform(X_test)

# Mengaktifkan fungsi klasifikasi KNN
knn = KNeighborsClassifier(n_neighbors=4)
knn.fit(X_train, y_train)

# Prediksi dengan data uji
y_pred = knn.predict(X_test)

# Evaluasi hasil prediksi
print(classification_report(y_test, y_pred))

# %%
"""
### **Grafik Line plot jumlah K=n**
"""

# %%
# Menyimpan akurasi untuk setiap nilai k
k_range = range(1, 21)
accuracies = []

# Menghitung akurasi untuk nilai k yang berbeda
for k in k_range:
    knn = KNeighborsClassifier(n_neighbors=k)
    knn.fit(X_train, y_train)
    accuracies.append(knn.score(X_test, y_test))

# Plot akurasi untuk setiap nilai k
plt.figure(figsize=(8, 4))
plt.plot(k_range, accuracies, marker='o', linestyle='--', color='b')
plt.title('Accuracy vs. Number of Neighbors (k)')
plt.xlabel('Number of Neighbors (k)')
plt.ylabel('Accuracy')
plt.xticks(np.arange(1, 21, 1))
plt.grid()
plt.show()

# %%
"""
## **Proses 2 melakukan Prediksi pada  Data testing**
"""

# %%
# Jangan dirunning

# Hapus kolom yang tidak diperlukan pada data latih
df_tandes = df_tandes.drop(columns=['Lokasi', 'Tanggal'], errors='ignore')

# Pilih variabel independen dan target
X = df_tandes[['PM10', 'PM2.5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]
y = df_tandes['Kategori']

# Membagi data menjadi data latih dan data uji
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.20, random_state=42)

# Normalisasi data
scaler = StandardScaler()
scaler.fit(X_train)
X_train = scaler.transform(X_train)
X_test = scaler.transform(X_test)

# Mengaktifkan fungsi klasifikasi KNN
knn = KNeighborsClassifier(n_neighbors=4)
knn.fit(X_train, y_train)

# Prediksi dengan data uji
y_pred = knn.predict(X_test)

# Hapus kolom yang tidak diperlukan pada data testing kolom Nomor
df_testing_tandes = df_testing_tandes.loc[:, ~df_testing_tandes.columns.str.contains('^Nomor')]

# Pilih fitur yang sama dengan data latih
X_new = df_testing_tandes[['PM10', 'PM2.5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]

# Standarisasi data baru dengan scaler yang sudah dilatih
X_new_scaled = scaler.transform(X_new)

# Prediksi kualitas udara untuk data baru
predictions = knn.predict(X_new_scaled)

# Menambahkan hasil prediksi ke data baru tanpa menghapus kolom 'Lokasi' dan 'Tanggal'
df_testing_tandes['kategori'] = predictions

# Tampilkan hasil prediksi beserta lokasi dan tanggal
df_tandes_testing_result = df_testing_tandes.reset_index(drop=True)
print("Prediksi Kualitas Udara untuk data baru:")
df_tandes_testing_result.head()

# %%
# Hapus kolom yang tidak diperlukan pada data testing kolom Nomor
df_testing_tandes = df_testing_tandes.loc[:, ~df_testing_tandes.columns.str.contains('^Nomor')]

# Pilih fitur yang sama dengan data latih
X_new = df_testing_tandes[['PM10', 'PM2.5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]

# Standarisasi data baru dengan scaler yang sudah dilatih
X_new_scaled = scaler.transform(X_new)

# Prediksi kualitas udara untuk data baru
predictions = knn.predict(X_new_scaled)

# Menambahkan hasil prediksi ke data baru tanpa menghapus kolom 'Lokasi' dan 'Tanggal'
df_testing_tandes['kategori'] = predictions

# Tampilkan hasil prediksi beserta lokasi dan tanggal
df_tandes_testing_result = df_testing_tandes.reset_index(drop=True)
df_tandes_testing_result.head()

# %%
"""
### **Classification report data Testing**
"""

# %%
# Tampilkan classification report
print(classification_report(y_test, y_pred))

# %%
"""
### **Menggabungkan kolom data training dan hasil prediksi data testing**
"""

# %%
# Hapus kolom yang tidak diperlukan dari df_tandess
df_tandess = df_tandess.drop(columns=['Max'], errors='ignore')

# Gabungkan df_tandess dan df_tandes_testing_result
df_tandes_combine = pd.concat([df_tandess, df_tandes_testing_result], ignore_index=True)

# Ganti NaN di 'Kategori' dengan nilai dari 'kategori'
df_tandes_combine['Kategori'] = df_tandes_combine['Kategori'].fillna(df_tandes_combine['kategori'])

# Hapus kolom 'kategori' yang sudah tidak diperlukan
df_tandes_combine = df_tandes_combine.drop(columns=['kategori'], errors='ignore')

# Tampilkan hasil
df_tandes_combine

# %%
"""
### **Pengecekan NaN pada data**
"""

# %%
print("\nJumlah NaN setelah penggabungan:")
print(df_tandes_combine.isnull().sum())

# %%
"""
## **Proses 3 melakukan Prediksi 30 hari kedepan dengan menggabungkan 2 data sebelumnya**
"""

# %%
# Hapus kolom yang tidak diperlukan pada data latih
df_tandes = df_tandes_combine.drop(columns=['Lokasi', 'Tanggal'], errors='ignore')

# Pilih variabel independen dan target
X = df_tandes[['PM10', 'PM2.5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]
y = df_tandes['Kategori']

# Membagi data menjadi data latih dan data uji
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.20, random_state=42)

# Normalisasi data
scaler = StandardScaler()
scaler.fit(X_train)
X_train = scaler.transform(X_train)
X_test = scaler.transform(X_test)

# Mengaktifkan fungsi klasifikasi KNN
knn = KNeighborsClassifier(n_neighbors=4)
knn.fit(X_train, y_train)

# Ambil tanggal terakhir dari data dan tanggal awal prediksi
last_date = pd.to_datetime("2024-10-28")    # Tanggal terakhir dari data
start_date = last_date + timedelta(days=1)  # Tanggal Mulai prediksi
lokasi = 'Tandes'

# Buat list untuk menyimpan hasil prediksi
predictions_list = []

# Buat DataFrame untuk 30 hari ke depan
for i in range(30):
    new_date = start_date + timedelta(days=i)

    # Ambil nilai terakhir dari data gabungan untuk prediksi
    last_row = df_tandes.iloc[-1]

    # Buat data baru berdasarkan nilai terakhir
    new_row = {
        'PM10': np.random.normal(last_row['PM10'], 10),
        'PM2.5': np.random.normal(last_row['PM2.5'], 5),
        'SO2': np.random.normal(last_row['SO2'], 2),
        'CO': np.random.normal(last_row['CO'], 2),
        'O3': np.random.normal(last_row['O3'], 3),
        'NO2': np.random.normal(last_row['NO2'], 2),
        'HC': np.random.normal(last_row['HC'], 5),
    }
    predictions_list.append(new_row)

# Buat DataFrame untuk 30 hari ke depan
df_future = pd.DataFrame(predictions_list)

# Standarisasi data baru dengan scaler yang sudah dilatih
X_future_scaled = scaler.transform(df_future)

# Prediksi kualitas udara untuk data baru
predictions = knn.predict(X_future_scaled)

# Buat DataFrame hasil prediksi
df_predicted = pd.DataFrame({
    'Lokasi': lokasi,
    'Tanggal': [(start_date + timedelta(days=i)).strftime('%d-%b-%y') for i in range(30)],
    'PM10': df_future['PM10'],
    'PM2.5': df_future['PM2.5'],
    'SO2': df_future['SO2'],
    'CO': df_future['CO'],
    'O3': df_future['O3'],
    'NO2': df_future['NO2'],
    'HC': df_future['HC'],
    'kategori': predictions
})

# Tampilkan hasil prediksi
df_predicted.head()

# %%
"""
### **Save data hasil Prediksi**
"""

# %%
# Simpan hasil prediksi ke dalam file CSV tanpa indeks
df_predicted.to_csv('prediksi_kualitas_udara.csv', index=False)

# %%
"""
### **Classification report data prediksi**
"""

# %%
# Prediksi dengan data uji
y_pred = knn.predict(X_test)

# Buat classification report
report = classification_report(y_test, y_pred)
accuracy = accuracy_score(y_test, y_pred)

# Tampilkan hasil
print("Classification Report:")
print(report)
print(f"Accuracy Prediksi data udara : {accuracy:.2f}%")

# %%
"""
### **Line Chart**
"""

# %%
# Mengatur ukuran grafik
plt.figure(figsize=(12, 6))

# Membuat line chart untuk PM10, PM2.5, SO2, CO, O3, NO2, HC
plt.plot(df_predicted['Tanggal'], df_predicted['PM10'], label='PM10', marker='o')
plt.plot(df_predicted['Tanggal'], df_predicted['PM2.5'], label='PM2.5', marker='o')
plt.plot(df_predicted['Tanggal'], df_predicted['SO2'], label='SO2', marker='o')
plt.plot(df_predicted['Tanggal'], df_predicted['CO'], label='CO', marker='o')
plt.plot(df_predicted['Tanggal'], df_predicted['O3'], label='O3', marker='o')
plt.plot(df_predicted['Tanggal'], df_predicted['NO2'], label='NO2', marker='o')
plt.plot(df_predicted['Tanggal'], df_predicted['HC'], label='HC', marker='o')

# Menambahkan judul dan label
plt.title('Prediksi Kualitas Udara Selama 30 Hari')
plt.xlabel('Tanggal')
plt.ylabel('Konsentrasi (µg/m³)')
plt.xticks(rotation=45)
plt.grid()
plt.tight_layout()

# Menempatkan legenda di luar grafik
plt.legend(loc='upper left', bbox_to_anchor=(1, 1))

# Menampilkan grafik
plt.show()

# %%
"""
### **Bar Chart**
"""

# %%
# Mengatur ukuran grafik
plt.figure(figsize=(12, 6))

# Menentukan lebar bar
bar_width = 0.15
index = range(len(df_predicted))

# Membuat bar chart untuk setiap parameter
plt.bar(index, df_predicted['PM10'], bar_width, label='PM10')
plt.bar([i + bar_width for i in index], df_predicted['PM2.5'], bar_width, label='PM2.5')
plt.bar([i + 2 * bar_width for i in index], df_predicted['SO2'], bar_width, label='SO2')
plt.bar([i + 3 * bar_width for i in index], df_predicted['CO'], bar_width, label='CO')
plt.bar([i + 4 * bar_width for i in index], df_predicted['O3'], bar_width, label='O3')
plt.bar([i + 5 * bar_width for i in index], df_predicted['NO2'], bar_width, label='NO2')
plt.bar([i + 6 * bar_width for i in index], df_predicted['HC'], bar_width, label='HC')

# Menambahkan judul dan label
plt.title('Prediksi Kualitas Udara Selama 30 Hari')
plt.xlabel('Tanggal')
plt.ylabel('Konsentrasi (µg/m³)')
plt.xticks([i + 3 * bar_width for i in index], df_predicted['Tanggal'], rotation=45)

# Menempatkan legenda di luar grafik
plt.legend(loc='upper left', bbox_to_anchor=(1, 1))

plt.tight_layout()

# Menampilkan grafik
plt.show()

# %%
"""
### **Pie Chart**
"""

# %%
# Menghitung rata-rata untuk setiap parameter
average_values = df_predicted[['PM10', 'PM2.5', 'SO2', 'CO', 'O3', 'NO2', 'HC']].mean()

# Mengatur ukuran grafik
plt.figure(figsize=(5, 5))

# Membuat pie chart
plt.pie(average_values, labels=average_values.index, autopct='%1.1f%%', startangle=140)

# Menambahkan judul
plt.title('Rata-Rata Konsentrasi Kualitas Udara Selama 30 Hari')

# Menampilkan grafik
plt.axis('equal')
plt.show()

# %%
"""
# **Konversi Intuisi dan wawasan data**
"""

# %%
url='https://drive.google.com/file/d/1xFqav8f58UVOf6yvgDa3PQhGM8F-cnFS/view?usp=drive_link'
url='https://drive.google.com/uc?id=' + url.split('/')[-2]
df2 = pd.read_csv(url)

# %%
df2.head()

# %%
df2.describe()

# %%
print(df2.isna().sum())

# %%
df2.info()

# %%
df2.columns

# %%
# Hapus kolom yang tidak berguna
df2 = df2.drop(columns=['Lokasi', 'Kordinat'], errors='ignore')

# Parameter baku mutu Air Badan Air berdasarkan kelas
baku_mutu = {
    1: {'pH_min': 6, 'pH_max': 9, 'DO_min': 6, 'BOD_max': 2, 'COD_max': 10, 'TSS_max': 40, 'Nitrat_max': 10, 'Fosfat_max': 0.2},
    2: {'pH_min': 6, 'pH_max': 9, 'DO_min': 4, 'BOD_max': 3, 'COD_max': 25, 'TSS_max': 50, 'Nitrat_max': 10, 'Fosfat_max': 0.2},
    3: {'pH_min': 6, 'pH_max': 9, 'DO_min': 3, 'BOD_max': 6, 'COD_max': 40, 'TSS_max': 100, 'Nitrat_max': 20, 'Fosfat_max': 1},
    4: {'pH_min': 6, 'pH_max': 9, 'DO_min': 1, 'BOD_max': 12, 'COD_max': 80, 'TSS_max': 400, 'Nitrat_max': 20, 'Fosfat_max': 10000}
}

# Fungsi untuk mengevaluasi kategori kualitas air
def evaluate_quality(row):
    kelas = row['Kelas']
    batas = baku_mutu.get(kelas, {})
    if (row['pH'] < batas['pH_min'] or row['pH'] > batas['pH_max'] or
        row['DO'] < batas['DO_min'] or
        row['BOD'] > batas['BOD_max'] or
        row['COD'] > batas['COD_max'] or
        row['TSS'] > batas['TSS_max'] or
        row['Nitrat'] > batas['Nitrat_max'] or
        row['Fosfat'] > batas['Fosfat_max']):
        return 'Berbahaya'
    return 'Baik'

# Tambahkan kolom kategori kualitas air
df2['Kualitas_Air'] = df2.apply(evaluate_quality, axis=1)

# Hapus spasi yang mungkin ada di nama kolom untuk mencegah eror
df2.columns = df2.columns.str.strip()

# Hitung jumlah untuk kategori 'Baik' dan 'Berbahaya' berdasarkan bulan dan tahun
df2['Tahun'] = pd.to_datetime(df2['Tahun'], format='%Y').dt.year
df2['Bulan'] = df2['Bulan'].astype(str)  # Pastikan bulan dalam format string

# Hitung jumlah untuk masing-masing tahun
jumlah_2023 = df2[df2['Tahun'] == 2023].groupby('Bulan')['Kualitas_Air'].value_counts().unstack(fill_value=0)
jumlah_2024 = df2[df2['Tahun'] == 2024].groupby('Bulan')['Kualitas_Air'].value_counts().unstack(fill_value=0)

# %%
# Pastikan 'Bulan' adalah integer untuk sorting
df2['Bulan'] = df2['Bulan'].astype(int)

# Hitung jumlah untuk masing-masing tahun dan urutkan berdasarkan Bulan
jumlah_2023 = df2[df2['Tahun'] == 2023].groupby('Bulan')['Kualitas_Air'].value_counts().unstack(fill_value=0).sort_index()
jumlah_2024 = df2[df2['Tahun'] == 2024].groupby('Bulan')['Kualitas_Air'].value_counts().unstack(fill_value=0).sort_index()

# Visualisasi line chart untuk bulan dengan kualitas air baik dan berbahaya
plt.figure(figsize=(15, 5))

# Tahun 2023
plt.subplot(1, 2, 1)
plt.plot(jumlah_2023.index, jumlah_2023['Baik'], marker='o', linestyle='-', color='b', label='Baik')
plt.plot(jumlah_2023.index, jumlah_2023['Berbahaya'], marker='o', linestyle='-', color='r', label='Berbahaya')
plt.title("Jumlah Kualitas Air per Bulan 2023")
plt.xlabel("Bulan")
plt.ylabel("Jumlah")
plt.xticks(jumlah_2023.index, labels=jumlah_2023.index.astype(str), rotation=45)
plt.grid()
plt.legend(loc='upper right', bbox_to_anchor=(1.30, 1))

# Tahun 2024
plt.subplot(1, 2, 2)
plt.plot(jumlah_2024.index, jumlah_2024['Baik'], marker='o', linestyle='-', color='b', label='Baik')
plt.plot(jumlah_2024.index, jumlah_2024['Berbahaya'], marker='o', linestyle='-', color='r', label='Berbahaya')
plt.title("Jumlah Kualitas Air per Bulan 2024")
plt.xlabel("Bulan")
plt.ylabel("Jumlah")
plt.xticks(jumlah_2024.index, labels=jumlah_2024.index.astype(str), rotation=45)
plt.grid()
plt.legend(loc='upper right', bbox_to_anchor=(1.30, 1))

plt.tight_layout()
plt.show()


# %%
# Hitung total untuk kategori 'Baik' dan 'Berbahaya' tahun 2023
total_berbahaya_2023 = jumlah_2023['Berbahaya'].sum()
total_baik_2023 = jumlah_2023['Baik'].sum()

# Hitung total untuk kategori 'Baik' dan 'Berbahaya' tahun 2024
total_berbahaya_2024 = jumlah_2024['Berbahaya'].sum()
total_baik_2024 = jumlah_2024['Baik'].sum()

# Data untuk pie chart tahun 2023
data_2023 = [total_berbahaya_2023, total_baik_2023]
labels = ['Berbahaya', 'Baik']
colors = ['red', 'blue']

# Data untuk pie chart tahun 2024
data_2024 = [total_berbahaya_2024, total_baik_2024]

# Visualisasi pie chart untuk tahun 2023 dan 2024 dalam satu figure berdampingan
fig, axes = plt.subplots(1, 2, figsize=(8, 4))

# Pie chart untuk tahun 2023
axes[0].pie(data_2023, labels=labels, colors=colors, autopct='%1.1f%%', startangle=90)
axes[0].set_title("Distribusi Kualitas Air 2023")
axes[0].axis('equal')

# Pie chart untuk tahun 2024
axes[1].pie(data_2024, labels=labels, colors=colors, autopct='%1.1f%%', startangle=90)
axes[1].set_title("Distribusi Kualitas Air 2024")
axes[1].axis('equal')

# Menampilkan grafik
plt.tight_layout()
plt.show()


# %%
# Hitung total untuk kategori 'Baik' dan 'Berbahaya' tahun 2023
total_berbahaya_2023 = jumlah_2023['Berbahaya'].sum()
total_baik_2023 = jumlah_2023['Baik'].sum()

# Hitung total untuk kategori 'Baik' dan 'Berbahaya' tahun 2024
total_berbahaya_2024 = jumlah_2024['Berbahaya'].sum()
total_baik_2024 = jumlah_2024['Baik'].sum()

# Data untuk pie chart tahun 2023
data_2023 = [total_berbahaya_2023, total_baik_2023]
labels_2023 = ['Berbahaya', 'Baik']
explode_2023 = [0.1] * len(data_2023)  # Membuat jarak pada semua kategori

# Data untuk pie chart tahun 2024
data_2024 = [total_berbahaya_2024, total_baik_2024]
labels_2024 = ['Berbahaya', 'Baik']
explode_2024 = [0.1] * len(data_2024)

# Membuat figure dengan dua subplot untuk grafik pie chart
fig, axes = plt.subplots(1, 2, figsize=(8, 6))

# Pie chart untuk tahun 2023
axes[0].pie(data_2023, labels=labels_2023, autopct='%1.1f%%', startangle=90, explode=explode_2023, colors=['red', 'blue'])
axes[0].set_title("Distribusi Kualitas Air 2023")
axes[0].axis('equal')  # Membuat pie chart berbentuk lingkaran sempurna

# Pie chart untuk tahun 2024
axes[1].pie(data_2024, labels=labels_2024, autopct='%1.1f%%', startangle=90, explode=explode_2024, colors=['red', 'blue'])
axes[1].set_title("Distribusi Kualitas Air 2024")
axes[1].axis('equal')  # Membuat pie chart berbentuk lingkaran sempurna

# Menampilkan grafik
plt.tight_layout()
plt.show()


# %%
# Fungsi untuk memberikan solusi berdasarkan parameter yang melebihi baku mutu
def check_exceedances_per_month(df):
    solusi_list = []

    # Kelompokkan data berdasarkan bulan dan tahun
    grouped = df.groupby(['Tahun', 'Bulan'])

    for (tahun, bulan), group in grouped:
        max_exceedance = {
            'parameter': None,
            'value': -1,
            'kelas': None
        }

        for index, row in group.iterrows():
            kelas = row['Kelas']
            batas = baku_mutu.get(kelas, {})
            current_exceedance = {}

            # Periksa parameter yang melebihi baku mutu
            if row['pH'] < batas.get('pH_min', float('-inf')) or row['pH'] > batas.get('pH_max', float('inf')):
                exceed_value = abs(row['pH'] - (batas['pH_min'] if row['pH'] < batas['pH_min'] else batas['pH_max']))
                current_exceedance['pH'] = exceed_value
            if row['DO'] < batas.get('DO_min', float('-inf')):
                exceed_value = batas['DO_min'] - row['DO']
                current_exceedance['DO'] = exceed_value
            if row['BOD'] > batas.get('BOD_max', float('inf')):
                exceed_value = row['BOD'] - batas['BOD_max']
                current_exceedance['BOD'] = exceed_value
            if row['COD'] > batas.get('COD_max', float('inf')):
                exceed_value = row['COD'] - batas['COD_max']
                current_exceedance['COD'] = exceed_value
            if row['TSS'] > batas.get('TSS_max', float('inf')):
                exceed_value = row['TSS'] - batas['TSS_max']
                current_exceedance['TSS'] = exceed_value
            if row['Nitrat'] > batas.get('Nitrat_max', float('inf')):
                exceed_value = row['Nitrat'] - batas['Nitrat_max']
                current_exceedance['Nitrat'] = exceed_value
            if row['Fosfat'] > batas.get('Fosfat_max', float('inf')):
                exceed_value = row['Fosfat'] - batas['Fosfat_max']
                current_exceedance['Fosfat'] = exceed_value

            # Cek parameter yang melebihi batas maksimum
            for param, exceed_value in current_exceedance.items():
                if exceed_value > max_exceedance['value']:
                    max_exceedance['parameter'] = param
                    max_exceedance['value'] = exceed_value
                    max_exceedance['kelas'] = kelas

        # Jika ada parameter yang melebihi baku mutu
        if max_exceedance['parameter']:
            solusi = (f"Sungai kelas {max_exceedance['kelas']} tahun {tahun} bulan {bulan}: "
                      f"Parameter {max_exceedance['parameter']} melebihi baku mutu sebesar "
                      f"{max_exceedance['value']:.2f}. "
                      "Perlu tindakan untuk menurunkan status air.")
            solusi_list.append(solusi)

    return solusi_list

# Terapkan fungsi untuk mendapatkan solusi berdasarkan data
solusi_output = check_exceedances_per_month(df2)

# Tampilkan solusi dengan format yang lebih rapi
print("\n".join(solusi_output))


# %%
# Korelasi antar variabel numerik
numeric_cols = df2.select_dtypes(include=[np.number])
corr_matrix = numeric_cols.corr()
plt.figure(figsize=(8, 6))
sns.heatmap(corr_matrix, annot=True, cmap='coolwarm', fmt=".2f")
plt.title("Korelasi Antar Variabel")
plt.show()

# %%
"""
## **Konversi Data story Telling**
"""

# %%
url='https://drive.google.com/file/d/16RShrtNcnlB8gLWX_EfTlXBoXmHGK7nU/view?usp=drive_link'
url='https://drive.google.com/uc?id=' + url.split('/')[-2]
df3 = pd.read_csv(url)

# %%
df3.head()

# %%
df3.info()

# %%
df3_filtered = df3[df3['Lokasi'].isin(['Wonorejo', 'Kebonsari'])]

# Menghapus kolom 'PM2.5', 'CO', dan 'HC'
df3_filtered = df3_filtered.drop(columns=['PM2.5', 'CO', 'HC','X','Y'])

# Mengubah format kolom 'Tanggal' menjadi 'YYYY-MM-DD'
df3_filtered['Tanggal'] = pd.to_datetime(df3_filtered['Tanggal'], format='%d-%b-%y').dt.strftime('%Y-%m-%d')

# Menyimpan DataFrame yang sudah difilter ke dalam file Excel
# df3_filtered.to_excel('df_Kebonsari&Wonerejo.xlsx', index=False)

# %%
df3_filtered.head()

# %%
df3_filtered.info()

# %%
df3_filtered.describe()

# %%
# Menghitung jumlah data untuk setiap lokasi
location_counts = df3_filtered['Lokasi'].value_counts()

# Membuat Bar Chart
plt.figure(figsize=(6, 5))
location_counts.plot(kind='bar', color=['skyblue', 'salmon'])
plt.title('Jumlah Data per Lokasi')
plt.xlabel('Lokasi')
plt.ylabel('Jumlah Data')
plt.xticks(rotation=0)
plt.grid(axis='y')
plt.tight_layout()
plt.show()

# %%
# Memfilter data untuk lokasi 'Wonorejo' dan 'Kebonsari'
filtered_data = df3_filtered[df3_filtered['Lokasi'].isin(['Wonorejo', 'Kebonsari'])]

# Mengubah kolom 'Tanggal' menjadi datetime
filtered_data['Tanggal'] = pd.to_datetime(filtered_data['Tanggal'], errors='coerce')

# Mengelompokkan data berdasarkan tahun dan lokasi, kemudian menghitung rata-rata
filtered_data['Tahun'] = filtered_data['Tanggal'].dt.year
avg_pollutants_yearly = filtered_data.groupby(['Tahun', 'Lokasi'])[['PM10', 'SO2', 'O3', 'NO2']].mean().reset_index()

# Mengubah format data untuk plotting
avg_pollutants_pivot = avg_pollutants_yearly.pivot(index='Tahun', columns='Lokasi', values=['PM10', 'SO2', 'O3', 'NO2'])

# Membuat Bar Chart
plt.figure(figsize=(12, 8))
avg_pollutants_pivot.plot(kind='bar', figsize=(10, 8))
plt.title('Rata-rata Kualitas Udara Tahunan di Wonorejo dan Kebonsari (2019-2024)')
plt.xlabel('Tahun')
plt.ylabel('Rata-rata Konsentrasi (µg/m³)')
plt.xticks(rotation=0)
plt.grid(axis='y')
plt.tight_layout()
plt.legend(title='Polutan', bbox_to_anchor=(1.05, 1), loc='upper left')
plt.show()

# %%
# Memfilter data untuk lokasi 'Wonerejo' dan 'Kebonsari'
filtered_data = df3_filtered[df3_filtered['Lokasi'].isin(['Wonorejo', 'Kebonsari'])]

# Mengubah kolom 'Tanggal' menjadi datetime dengan inferensi format
filtered_data['Tanggal'] = pd.to_datetime(filtered_data['Tanggal'], errors='coerce')

# Mengelompokkan data berdasarkan tanggal dan lokasi, kemudian menghitung rata-rata
daily_avg = filtered_data.groupby(['Tanggal', 'Lokasi']).mean().reset_index()

# Membuat Line Chart untuk Kebonsari
plt.figure(figsize=(12, 6))
kebonsari_data = daily_avg[daily_avg['Lokasi'] == 'Kebonsari']
plt.plot(kebonsari_data['Tanggal'], kebonsari_data['PM10'], label='PM10', color='blue')
plt.plot(kebonsari_data['Tanggal'], kebonsari_data['SO2'], label='SO2', color='orange')
plt.plot(kebonsari_data['Tanggal'], kebonsari_data['O3'], label='O3', color='green')
plt.plot(kebonsari_data['Tanggal'], kebonsari_data['NO2'], label='NO2', color='red')
plt.title('Tren Kualitas Udara di Kebonsari')
plt.xlabel('Tanggal')
plt.ylabel('Konsentrasi (µg/m³)')
plt.grid()
plt.legend(loc='upper right', bbox_to_anchor=(1.15, 1))
plt.tight_layout()
plt.show()

# %%
# Membuat Line Chart untuk Wonerejo
plt.figure(figsize=(12, 6))
wonerejo_data = daily_avg[daily_avg['Lokasi'] == 'Wonorejo']
plt.plot(wonerejo_data['Tanggal'], wonerejo_data['PM10'], label='PM10', color='blue')
plt.plot(wonerejo_data['Tanggal'], wonerejo_data['SO2'], label='SO2', color='orange')
plt.plot(wonerejo_data['Tanggal'], wonerejo_data['O3'], label='O3', color='green')
plt.plot(wonerejo_data['Tanggal'], wonerejo_data['NO2'], label='NO2', color='red')
plt.title('Tren Kualitas Udara di Wonorejo')
plt.xlabel('Tanggal')
plt.ylabel('Konsentrasi (µg/m³)')
plt.grid()
plt.legend(loc='upper right', bbox_to_anchor=(1.15, 1))
plt.tight_layout()
plt.show()

# %%
# Memfilter data untuk lokasi 'Wonerejo' dan 'Kebonsari'
filtered_data = df3_filtered[df3_filtered['Lokasi'].isin(['Wonorejo', 'Kebonsari'])]

# Menghitung rata-rata untuk setiap polutan berdasarkan lokasi
avg_pollutants = filtered_data.groupby('Lokasi')[['PM10', 'SO2', 'O3', 'NO2']].mean()

# Membuat subplots untuk Pie Charts
fig, axs = plt.subplots(1, 2, figsize=(10, 6))

# Pie Chart untuk Kebonsari
axs[0].pie(avg_pollutants.loc['Kebonsari'], labels=avg_pollutants.columns, autopct='%1.1f%%', startangle=90)
axs[0].axis('equal')  # Equal aspect ratio ensures that pie is drawn as a circle.
axs[0].set_title('Presentasi Kualitas Udara di Kebonsari')

# Pie Chart untuk Wonerejo
axs[1].pie(avg_pollutants.loc['Wonorejo'], labels=avg_pollutants.columns, autopct='%1.1f%%', startangle=90)
axs[1].axis('equal')
axs[1].set_title('Presentasi Kualitas Udara di Wonorejo')

plt.tight_layout()
plt.show()

# %%
"""
## **Analitik Data Kota Cerdas Berkelanjutan**
"""

# %%
