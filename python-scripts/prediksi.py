# pip install openpyxl

import mysql.connector
import pandas as pd
import numpy as np
import matplotlib.pyplot as plt
from sklearn.model_selection import train_test_split
from datetime import datetime, timedelta
from sklearn.preprocessing import StandardScaler
from sklearn.neighbors import KNeighborsClassifier
from sklearn.metrics import classification_report
from sklearn.preprocessing import LabelEncoder
from sklearn.metrics import classification_report, accuracy_score

# url='https://drive.google.com/file/d/1cise3_z4FW5mJ1Qfp9QK-8rf7MwLt3ka/view?usp=sharing'
# url='https://drive.google.com/uc?id=' + url.split('/')[-2]
# df = pd.read_csv(url)

# Koneksi ke database MySQL
connection = mysql.connector.connect(
    host='127.0.0.1',      # ganti dengan host MySQL Anda
    user='root',           # ganti dengan username MySQL Anda
    password='',   # ganti dengan password MySQL Anda
    database='beritadlh'   # ganti dengan nama database Anda
)
query = "SELECT * FROM data_spkuas"  # ganti dengan query yang sesuai
df = pd.read_sql(query, connection)

df.head()

df.info()

# Memfilter data untuk lokasi "Tandes"
df_tandes = df[df['lokasi'] == 'Tandes']

# Reset index dan drop kolom nomor jika berasal dari CSV
df_tandes = df_tandes.reset_index(drop=True)

# Membagi data menjadi 80% untuk training dan 20% untuk testing berdasarkan indeks
split_index = int(len(df_tandes) * 0.8)
df_training_tandes = df_tandes.iloc[:split_index]
df_testing_tandes = df_tandes.iloc[split_index:]

# Menampilkan informasi dari kedua dataset
print(f"Data Training: {df_training_tandes.shape}")
print(f"Data Testing : {df_testing_tandes.shape}")


df_training_tandes.head()

df_testing_tandes.head()

# Simpan hasil prediksi ke dalam file Excel tanpa indeks
df_training_tandes.to_excel('Training_udara.xlsx', index=False)

# Simpan hasil prediksi ke dalam file Excel tanpa indeks
df_testing_tandes.to_excel('Testing_udara.xlsx', index=False)

df_testing_tandes.info()

df_training_tandes.info()

# Memfilter data untuk lokasi "Tandes" dan membuat df_tandes
df_tandes = df_training_tandes[df_training_tandes['lokasi'] == 'Tandes'].copy()

# Menambahkan kolom "Max" dengan nilai maksimum dari parameter (PM10, PM2_5, SO2, CO, O3, NO2, HC)
parameter_columns = ['PM10', 'PM2_5', 'SO2', 'CO', 'O3', 'NO2', 'HC']
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

# Menampilkan hasil
df_tandes.head()

# Simpan hasil prediksi ke dalam file Excel tanpa indeks
df_tandess.to_excel('training_Tandes_udara.xlsx', index=False)

df_tandess.head()

df_tandess.info()

df_tandess.head()

# Pilih variabel independen dan target
X = df_tandes[['PM10', 'PM2_5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]
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

# Jangan dirunning

# Hapus kolom yang tidak diperlukan pada data latih
df_tandes = df_tandes.drop(columns=['lokasi', 'tanggal'], errors='ignore')

# Pilih variabel independen dan target
X = df_tandes[['PM10', 'PM2_5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]
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
X_new = df_testing_tandes[['PM10', 'PM2_5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]

# Standarisasi data baru dengan scaler yang sudah dilatih
X_new_scaled = scaler.transform(X_new)

# Prediksi kualitas udara untuk data baru
predictions = knn.predict(X_new_scaled)

# Menambahkan hasil prediksi ke data baru tanpa menghapus kolom 'lokasi' dan 'tanggal'
df_testing_tandes['kategori'] = predictions

# Tampilkan hasil prediksi beserta lokasi dan tanggal
df_tandes_testing_result = df_testing_tandes.reset_index(drop=True)
print("Prediksi Kualitas Udara untuk data baru:")
df_tandes_testing_result.head()

# Hapus kolom yang tidak diperlukan pada data testing kolom Nomor
df_testing_tandes = df_testing_tandes.loc[:, ~df_testing_tandes.columns.str.contains('^Nomor')]

# Pilih fitur yang sama dengan data latih
X_new = df_testing_tandes[['PM10', 'PM2_5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]

# Standarisasi data baru dengan scaler yang sudah dilatih
X_new_scaled = scaler.transform(X_new)

# Prediksi kualitas udara untuk data baru
predictions = knn.predict(X_new_scaled)

# Menambahkan hasil prediksi ke data baru tanpa menghapus kolom 'lokasi' dan 'tanggal'
df_testing_tandes['kategori'] = predictions

# Tampilkan hasil prediksi beserta lokasi dan tanggal
df_tandes_testing_result = df_testing_tandes.reset_index(drop=True)
df_tandes_testing_result.head()

# Tampilkan classification report
print(classification_report(y_test, y_pred))

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

print("\nJumlah NaN setelah penggabungan:")
print(df_tandes_combine.isnull().sum())

# Hapus kolom yang tidak diperlukan pada data latih
df_tandes = df_tandes_combine.drop(columns=['lokasi', 'tanggal'], errors='ignore')

# Pilih variabel independen dan target
X = df_tandes[['PM10', 'PM2_5', 'SO2', 'CO', 'O3', 'NO2', 'HC']]
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
last_date = pd.to_datetime("2024-10-28")    # tanggal terakhir dari data
start_date = last_date + timedelta(days=1)  # tanggal Mulai prediksi
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
        'PM2_5': np.random.normal(last_row['PM2_5'], 5),
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
    'lokasi': lokasi,
    'tanggal': [(start_date + timedelta(days=i)).strftime('%d-%b-%y') for i in range(30)],
    'PM10': df_future['PM10'],
    'PM2_5': df_future['PM2_5'],
    'SO2': df_future['SO2'],
    'CO': df_future['CO'],
    'O3': df_future['O3'],
    'NO2': df_future['NO2'],
    'HC': df_future['HC'],
    'kategori': predictions
})

# Tampilkan hasil prediksi
df_predicted.tail()

# Simpan hasil prediksi ke dalam file CSV tanpa indeks
df_predicted.to_csv('prediksi_kualitas_udara.csv', index=False)

# Prediksi dengan data uji
y_pred = knn.predict(X_test)

# Buat classification report
report = classification_report(y_test, y_pred)
accuracy = accuracy_score(y_test, y_pred)

# Tampilkan hasil
print("Classification Report:")
print(report)
print(f"Accuracy Prediksi data udara : {accuracy:.2f}%")

# Mengatur ukuran grafik
plt.figure(figsize=(12, 6))

# Membuat line chart untuk PM10, PM2_5, SO2, CO, O3, NO2, HC
plt.plot(df_predicted['tanggal'], df_predicted['PM10'], label='PM10', marker='o')
plt.plot(df_predicted['tanggal'], df_predicted['PM2_5'], label='PM2_5', marker='o')
plt.plot(df_predicted['tanggal'], df_predicted['SO2'], label='SO2', marker='o')
plt.plot(df_predicted['tanggal'], df_predicted['CO'], label='CO', marker='o')
plt.plot(df_predicted['tanggal'], df_predicted['O3'], label='O3', marker='o')
plt.plot(df_predicted['tanggal'], df_predicted['NO2'], label='NO2', marker='o')
plt.plot(df_predicted['tanggal'], df_predicted['HC'], label='HC', marker='o')

# Menambahkan judul dan label
# plt.title('Prediksi Kualitas Udara Selama 30 Hari')
plt.xlabel('tanggal')
plt.ylabel('Konsentrasi (µg/m³)')
plt.xticks(rotation=45)
plt.grid()
plt.tight_layout()

# Menempatkan legenda di luar grafik
plt.legend(loc='upper left', bbox_to_anchor=(1, 1))

save_path = 'C:/laragon/www/WEBDATA-DLH/public/img/air_quality_chart.png'
plt.savefig(save_path, dpi=300, bbox_inches='tight')

# Menampilkan grafik
plt.show()

# Mengatur ukuran grafik
plt.figure(figsize=(12, 6))

# Menentukan lebar bar
bar_width = 0.15
index = range(len(df_predicted))

# Membuat bar chart untuk setiap parameter
plt.bar(index, df_predicted['PM10'], bar_width, label='PM10')
plt.bar([i + bar_width for i in index], df_predicted['PM2_5'], bar_width, label='PM2_5')
plt.bar([i + 2 * bar_width for i in index], df_predicted['SO2'], bar_width, label='SO2')
plt.bar([i + 3 * bar_width for i in index], df_predicted['CO'], bar_width, label='CO')
plt.bar([i + 4 * bar_width for i in index], df_predicted['O3'], bar_width, label='O3')
plt.bar([i + 5 * bar_width for i in index], df_predicted['NO2'], bar_width, label='NO2')
plt.bar([i + 6 * bar_width for i in index], df_predicted['HC'], bar_width, label='HC')

# Menambahkan judul dan label
plt.title('Prediksi Kualitas Udara Selama 30 Hari')
plt.xlabel('tanggal')
plt.ylabel('Konsentrasi (µg/m³)')
plt.xticks([i + 3 * bar_width for i in index], df_predicted['tanggal'], rotation=45)

# Menempatkan legenda di luar grafik
plt.legend(loc='upper left', bbox_to_anchor=(1, 1))

plt.tight_layout()

# Menampilkan grafik
plt.show()

# Menghitung rata-rata untuk setiap parameter
average_values = df_predicted[['PM10', 'PM2_5', 'SO2', 'CO', 'O3', 'NO2', 'HC']].mean()

# Mengatur ukuran grafik
plt.figure(figsize=(5, 5))

# Membuat pie chart
plt.pie(average_values, labels=average_values.index, autopct='%1.1f%%', startangle=140)
# plt.savefig('C:/laragon/www/WEBDATA-DLH/public/img/air_quality_piechart.png')
# plt.close()
# Menambahkan judul
# plt.title('Rata-Rata Konsentrasi Kualitas Udara Selama 30 Hari')

# Menampilkan grafik
plt.axis('equal')
save_path = 'C:/laragon/www/WEBDATA-DLH/public/img/air_quality_piechart.png'
plt.savefig(save_path, dpi=300, bbox_inches='tight')
plt.show()



# Menutup koneksi setelah operasi selesai
connection.close()








