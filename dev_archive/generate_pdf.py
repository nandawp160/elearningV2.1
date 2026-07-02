from fpdf import FPDF

pdf = FPDF()
pdf.add_page()
pdf.set_font("helvetica", "B", 16)
pdf.cell(0, 10, "Jawaban Ulangan Harian Bab 1: Teks LHO", ln=True, align="C")
pdf.ln(10)

pdf.set_font("helvetica", "", 12)

content = [
    "1. Definisi dan Tujuan Utama Teks LHO:",
    "   - Definisi: Teks Laporan Hasil Observasi (LHO) adalah teks yang berfungsi untuk memberikan informasi secara umum tentang sesuatu berdasarkan fakta dari hasil pengamatan secara langsung.",
    "   - Tujuan Utama: Untuk menyajikan informasi mengenai klasifikasi atau jenis-jenis sesuatu secara apa adanya sesuai dengan kriteria tertentu berdasarkan hasil pengamatan yang sistematis dan objektif.",
    "",
    "2. Struktur Membangun Teks LHO:",
    "   - Pernyataan Umum: Merupakan bagian pembuka atau pengantar mengenai hal yang akan dilaporkan.",
    "   - Deskripsi Bagian: Berisi perincian atau penjelasan detail mengenai objek yang diamati.",
    "   - Deskripsi Manfaat: Bagian yang menjelaskan manfaat atau fungsi dari objek yang diamati bagi kehidupan atau lingkungan.",
    "",
    "Dikerjakan oleh: Andi Pratama (Siswa)",
]

for line in content:
    pdf.multi_cell(0, 10, line)

pdf.output("Jawaban_LHO_Andi.pdf")
print("PDF generated successfully: Jawaban_LHO_Andi.pdf")
