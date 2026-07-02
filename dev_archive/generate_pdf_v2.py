from reportlab.lib.pagesizes import letter
from reportlab.pdfgen import canvas
from reportlab.lib.units import inch

def generate_pdf(filename):
    c = canvas.Canvas(filename, pagesize=letter)
    width, height = letter

    # Title
    c.setFont("Helvetica-Bold", 16)
    c.drawCentredString(width/2, height - 1*inch, "Jawaban Ulangan Harian Bab 1: Teks LHO")
    
    c.setFont("Helvetica", 12)
    text_object = c.beginText(1*inch, height - 1.5*inch)
    text_object.setFont("Helvetica-Bold", 12)
    text_object.textLine("1. Definisi dan Tujuan Utama Teks LHO:")
    text_object.setFont("Helvetica", 11)
    text_object.textLine("   - Definisi: Teks Laporan Hasil Observasi (LHO) adalah teks yang berfungsi untuk memberikan")
    text_object.textLine("     informasi secara umum tentang sesuatu berdasarkan fakta dari hasil pengamatan langsung.")
    text_object.textLine("   - Tujuan Utama: Untuk menyajikan informasi mengenai klasifikasi sesuatu secara apa adanya.")
    text_object.textLine("")
    
    text_object.setFont("Helvetica-Bold", 12)
    text_object.textLine("2. Struktur Membangun Teks LHO:")
    text_object.setFont("Helvetica", 11)
    text_object.textLine("   - Pernyataan Umum: Bagian pembuka atau pengantar mengenai hal yang akan dilaporkan.")
    text_object.textLine("   - Deskripsi Bagian: Berisi perincian atau penjelasan detail mengenai objek yang diamati.")
    text_object.textLine("   - Deskripsi Manfaat: Bagian yang menjelaskan manfaat objek bagi kehidupan.")
    text_object.textLine("")
    text_object.textLine("")
    text_object.setFont("Helvetica-Oblique", 10)
    text_object.textLine("Dikerjakan oleh: Andi Pratama (Siswa)")
    
    c.drawText(text_object)
    c.showPage()
    c.save()

if __name__ == "__main__":
    generate_pdf("Jawaban_LHO_Andi.pdf")
    print("PDF generated successfully: Jawaban_LHO_Andi.pdf")
