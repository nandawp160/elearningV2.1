from fpdf import FPDF

class PDF(FPDF):
    def header(self):
        self.set_font('Helvetica', 'B', 12)
        self.cell(0, 10, 'Latihan Soal Bahasa Inggris - Tenses', 0, 1, 'C')
        self.ln(5)

    def footer(self):
        self.set_y(-15)
        self.set_font('Helvetica', 'I', 8)
        self.cell(0, 10, f'Page {self.page_no()}', 0, 0, 'C')

pdf = FPDF()
pdf.add_page()
pdf.set_font("Helvetica", size=11)

questions = [
    {
        "q": "1. My father ___ coffee every morning before going to work.",
        "options": ["A. drink", "B. drinks", "C. drinking", "D. drank", "E. to drink"]
    },
    {
        "q": "2. They ___ to the beautiful beach in Bali last holiday.",
        "options": ["A. go", "B. goes", "C. went", "D. gone", "E. going"]
    },
    {
        "q": "3. ___ you happy with the exam result today?",
        "options": ["A. Do", "B. Does", "C. Are", "D. Is", "E. Did"]
    },
    {
        "q": "4. The sun always ___ in the east and sets in the west.",
        "options": ["A. rise", "B. rose", "C. rises", "D. rising", "E. risen"]
    },
    {
        "q": "5. She ___ not come to the party last night because she was sick.",
        "options": ["A. does", "B. do", "C. is", "D. did", "E. was"]
    }
]

for item in questions:
    pdf.multi_cell(0, 7, item["q"])
    for opt in item["options"]:
        pdf.set_x(20)
        pdf.cell(0, 6, opt, ln=True)
    pdf.ln(3)

pdf.output("soal_bahasa_inggris.pdf")
print("PDF created successfully: soal_bahasa_inggris.pdf")
