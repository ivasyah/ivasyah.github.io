#include <iostream>
#include <string>

using namespace std;

// Fungsi konversi Kilometer/jam ke (Meter/detik, CentiMeter/detik, Mil/jam)
float km_to_m_s(float km_per_hour) {
    return km_per_hour * 1000;
}

float km_to_cm_s(float km_per_hour) {
    return km_per_hour * 1000 * 100;
}

float km_to_mil_h(float km_per_hour) {
    return km_per_hour * 1609.34;
}

// Fungsi konversi Centimeter/detik ke (Kilometer/jam, Meter/detik, Mil/jam)
float cm_to_km_h(float cm_per_second) {
    return cm_per_second / 100000;
}

float cm_to_m_s(float cm_per_second) {
    return cm_per_second / 100;
}

float cm_to_mil_h(float cm_per_second) {
    return cm_per_second / 1609.34;
}

// Fungsi konversi Meter/detik ke (Kilometer/jam, Centimeter/detik, Mil/jam)
float m_to_km_h(float m_per_second) {
    return m_per_second / 1000;
}

float m_to_cm_s(float m_per_second) {
    return m_per_second * 100;
}

float m_to_mil_h(float m_per_second) {
    return m_per_second * 2.23694;
}

// Fungsi konversi Mil/jam ke (Kilometer/jam, Centimeter/detik, Meter/detik)
float mil_to_km_h(float mil_per_hour) {
    return mil_per_hour * 1.60934;
}

float mil_to_cm_s(float mil_per_hour) {
    return mil_per_hour * 1.60934 * 1000;
}

float mil_to_m_s(float mil_per_hour) {
    return mil_per_hour * 1.60934 * 1000 * 100;
}

int main() {
    std::string nama, nim;
    int count = 0;

    while (count < 3) {
        cout << "Masukkan Nama: ";
        getline(cin, nama);
        cout << "Masukkan NIM: ";
        getline(cin, nim);

        if (nama == "irvan tampan" && nim == "2309106070") {
            cout << "Login Berhasil! Selamat datang, Irvan Tampan.\n";
            break;
        } else {
            count++;
            cout << "Login Gagal! Silakan coba lagi.\n";
        }
    }

    if (count == 3) {
        cout << "Anda telah salah login sebanyak 3 kali. Program berhenti.\n";
        return 0;
    }

    char repeat;
    do {
        int choice;
        float input;

        cout << "Menu Konversi" << endl;
        cout << "1. Konversi Kilometer/jam ke (Centimeter/detik, Meter/detik, Mil/jam)" << endl;
        cout << "2. Konversi Centimeter/detik ke (Kilometer/jam, Meter/detik, Mil/jam)" << endl;
        cout << "3. Konversi Meter/detik ke (Kilometer/jam, Centimeter/detik, Mil/jam)" << endl;
        cout << "4. Konversi Mil/jam ke (Kilometer/jam, Centimeter/detik, Meter/detik)" << endl;
        cout << "Masukkan pilihan: ";
        cin >> choice;

        switch (choice) {
            case 1:
                cout << "Masukkan nilai Kilometer/jam: ";
                cin >> input;
                cout << "Konversi hasil sebagai berikut " << endl;
                cout << "Meter/detik: " << km_to_m_s(input) << endl;
                cout << "Centimeter/detik: " << km_to_cm_s(input) << endl;
                cout << "Mil/jam: " << km_to_mil_h(input) << endl;
                break;
            case 2:
                cout << "Masukkan nilai Centimeter/detik: ";
                cin >> input;
                cout << "Konversi hasil sebagai berikut " << endl;
                cout << "Kilometer/jam: " << cm_to_km_h(input) << endl;
                cout << "Meter/detik: " << cm_to_m_s(input) << endl;
                cout << "Mil/jam: " << cm_to_mil_h(input) << endl;
                break;
            case 3:
                cout << "Masukkan nilai Meter/detik: ";
                cin >> input;
                cout << "Konversi hasil sebagai berikut " << endl;
                cout << "Kilometer/jam: " << m_to_km_h(input) << endl;
                cout << "Centimeter/detik: " << m_to_cm_s(input) << endl;
                cout << "Mil/jam: " << m_to_mil_h(input) << endl;
                break;
            case 4:
                cout << "Masukkan nilai Mil/jam: ";
                cin >> input;
                cout << "Konversi hasil sebagai berikut " << endl;
                cout << "Kilometer/jam: " << mil_to_km_h(input) << endl;
                cout << "Centimeter/detik: " << mil_to_cm_s(input) << endl;
                cout << "Meter/detik: " << mil_to_m_s(input) << endl;
                break;
            default:
                cout << "Pilihan tidak valid." << endl;
                break;
        }

        cout << "Ada lagi? (y/n): ";
        cin >> repeat;

    } while (repeat == 'y' || repeat == 'Y');

    return 0;
}
