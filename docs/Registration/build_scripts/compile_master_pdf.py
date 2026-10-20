# -*- coding: utf-8 -*-
"""
Master HTML & PDF Compiler for Zengfy Registration Documentation.
Renders all 11 markdown files into a single publication-grade HTML document
and compiles it into a vector PDF using headless Google Chrome.
"""

import os
import re
import subprocess
import markdown_it

DOCS_DIR = r"P:\Zengfy-Ecosystem\core\docs\Registration"
HTML_OUTPUT = os.path.join(DOCS_DIR, "Zengfy-Registration-Masterclass.html")
PDF_OUTPUT = os.path.join(DOCS_DIR, "Zengfy-Registration-Engineering-Masterclass.pdf")
CHROME_PATH = r"C:\Program Files\Google\Chrome\Application\chrome.exe"

FILES = [
    "README.md",
    "01-Registration-Fundamentals-And-Theory.md",
    "02-System-Design-And-Architecture.md",
    "03-Security-Cryptography-And-Hardening.md",
    "04-Verification-Mechanisms-Email-Vs-Phone.md",
    "05-Real-World-Edge-Cases-And-Production-Bugs.md",
    "06-Case-Studies-Industry-Analysis.md",
    "07-Zengfy-Implementation-Blueprint.md",
    "08-IT-Company-Roles-And-Engineering-Workflow.md",
    "09-Day-0-Root-Scenario-Implementation-Guide.md",
    "10-Testing-QA-And-DevOps-Runbook.md"
]

def format_callouts(html):
    # Convert blockquote callouts like > [!NOTE], > [!TIP], > [!WARNING]
    def repl_note(match):
        kind = match.group(1).upper()
        content = match.group(2)
        border_color = "#3b82f6"
        bg_color = "#eff6ff"
        title = "NOTE (বিশেষ দ্রষ্টব্য)"
        icon = "💡"
        
        if kind == "TIP":
            border_color = "#10b981"
            bg_color = "#ecfdf5"
            title = "TIP (টিপস)"
            icon = "⚡"
        elif kind == "WARNING":
            border_color = "#f59e0b"
            bg_color = "#fffbeb"
            title = "WARNING (সতর্কবার্তা)"
            icon = "⚠️"
        elif kind == "IMPORTANT" or kind == "CAUTION":
            border_color = "#ef4444"
            bg_color = "#fef2f2"
            title = "IMPORTANT (গুরুত্বপূর্ণ সতর্কতা)"
            icon = "🚨"

        return f'''<div class="callout-box" style="border-left: 4px solid {border_color}; background-color: {bg_color}; padding: 14px 18px; margin: 20px 0; border-radius: 8px;">
            <div style="font-weight: 700; color: #1e293b; margin-bottom: 6px; font-size: 0.9em; display: flex; items-center; gap: 8px;">
                <span>{icon}</span> <span>{title}</span>
            </div>
            <div style="color: #334155; font-size: 0.95em; line-height: 1.6;">{content}</div>
        </div>'''

    pattern = r'<blockquote>\s*<p>\[!(NOTE|TIP|WARNING|IMPORTANT|CAUTION)\]\s*(.*?)</p>\s*</blockquote>'
    return re.sub(pattern, repl_note, html, flags=re.DOTALL)

def build_master_html():
    md = markdown_it.MarkdownIt().enable('table')
    
    sections_html = []
    
    for idx, fname in enumerate(FILES):
        fpath = os.path.join(DOCS_DIR, fname)
        if not os.path.exists(fpath):
            print(f"File not found: {fpath}")
            continue
            
        with open(fpath, "r", encoding="utf-8-sig") as f:
            md_content = f.read()

        html_content = md.render(md_content)
        html_content = format_callouts(html_content)
        
        # Add page break before each chapter except the first
        page_break_class = "page-break-chapter" if idx > 0 else "cover-lead"
        section = f'''
        <section class="{page_break_class}" id="section-{idx}">
            <div class="chapter-badge">মডিউল {idx:02d} / ১১</div>
            {html_content}
        </section>
        '''
        sections_html.append(section)

    all_sections = "\n<hr class='chapter-divider' />\n".join(sections_html)

    html_template = f'''<!DOCTYPE html>
<html lang="bn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zengfy Sovereign Registration & Identity Engineering Masterclass</title>
    <!-- Google Fonts: Noto Sans Bengali, Plus Jakarta Sans, Fira Code -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Code:wght@400;500;600&family=Noto+Sans+Bengali:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        :root {{
            --primary: #1d4ed8;
            --primary-dark: #1e40af;
            --slate-900: #0f172a;
            --slate-800: #1e293b;
            --slate-700: #334155;
            --slate-600: #475569;
            --slate-100: #f1f5f9;
            --slate-50: #f8fafc;
            --border-color: #e2e8f0;
        }}

        @page {{
            size: A4 portrait;
            margin: 18mm 16mm 18mm 16mm;
            @bottom-right {{
                content: counter(page);
                font-family: 'Plus Jakarta Sans', sans-serif;
                font-size: 9pt;
                color: #64748b;
            }}
        }}

        *, *::before, *::after {{
            box-sizing: border-box;
        }}

        body {{
            font-family: 'Noto Sans Bengali', 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            font-size: 11pt;
            line-height: 1.7;
            color: var(--slate-800);
            background-color: #ffffff;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }}

        .container {{
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 30px;
        }}

        /* Cover Page Styling */
        .cover-page {{
            page-break-after: always;
            min-height: 90vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 60px 20px;
            border-bottom: 2px solid var(--border-color);
            margin-bottom: 40px;
        }}

        .cover-logo {{
            width: 72px;
            height: 72px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #ffffff;
            font-size: 38px;
            font-weight: 900;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
            margin-bottom: 25px;
        }}

        .cover-title {{
            font-size: 26pt;
            font-weight: 900;
            color: var(--slate-900);
            line-height: 1.25;
            margin: 0 0 16px 0;
            letter-spacing: -0.5px;
        }}

        .cover-subtitle {{
            font-size: 13pt;
            font-weight: 500;
            color: var(--slate-600);
            max-width: 650px;
            margin: 0 0 35px 0;
            line-height: 1.5;
        }}

        .cover-meta {{
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
            font-size: 9.5pt;
            color: var(--slate-600);
        }}

        .meta-pill {{
            background: var(--slate-100);
            border: 1px solid var(--border-color);
            padding: 6px 14px;
            border-radius: 20px;
            font-weight: 600;
        }}

        /* Typography */
        h1, h2, h3, h4, h5, h6 {{
            color: var(--slate-900);
            font-weight: 800;
            line-height: 1.3;
            margin-top: 1.8em;
            margin-bottom: 0.6em;
            page-break-after: avoid;
        }}

        h1 {{
            font-size: 20pt;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 10px;
            color: var(--primary-dark);
        }}

        h2 {{
            font-size: 15pt;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 6px;
        }}

        h3 {{
            font-size: 12.5pt;
        }}

        p {{
            margin-top: 0;
            margin-bottom: 1.1em;
            text-align: justify;
        }}

        a {{
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }}

        a:hover {{
            text-decoration: underline;
        }}

        /* Code & Monospace */
        code {{
            font-family: 'Fira Code', 'Consolas', monospace;
            font-size: 0.88em;
            background-color: var(--slate-100);
            color: #b91c1c;
            padding: 2px 6px;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }}

        pre {{
            background-color: #0f172a;
            color: #f8fafc;
            padding: 16px 20px;
            border-radius: 10px;
            overflow-x: auto;
            font-size: 8.5pt;
            line-height: 1.55;
            margin: 18px 0;
            page-break-inside: avoid;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }}

        pre code {{
            background: transparent;
            color: #f8fafc;
            padding: 0;
            border: none;
            font-size: inherit;
        }}

        /* Tables */
        table {{
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 9.5pt;
            page-break-inside: avoid;
        }}

        table th, table td {{
            border: 1px solid var(--border-color);
            padding: 10px 14px;
            text-align: left;
            vertical-align: top;
        }}

        table th {{
            background-color: var(--slate-100);
            font-weight: 700;
            color: var(--slate-900);
        }}

        table tr:nth-child(even) {{
            background-color: #fcfdfe;
        }}

        /* Quotes & Badges */
        blockquote {{
            margin: 16px 0;
            padding: 10px 18px;
            border-left: 4px solid var(--primary);
            background: var(--slate-50);
            color: var(--slate-700);
            font-style: italic;
            border-radius: 0 8px 8px 0;
        }}

        .chapter-badge {{
            display: inline-block;
            font-size: 8.5pt;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--primary);
            background: #dbeafe;
            padding: 4px 10px;
            border-radius: 6px;
            margin-bottom: 10px;
        }}

        .chapter-divider {{
            border: none;
            border-top: 1px dashed #cbd5e1;
            margin: 40px 0;
        }}

        .page-break-chapter {{
            page-break-before: always;
            padding-top: 15px;
        }}

        /* Lists */
        ul, ol {{
            padding-left: 24px;
            margin-bottom: 1.2em;
        }}

        li {{
            margin-bottom: 0.4em;
        }}

        /* Print specific */
        @media print {{
            body {{
                font-size: 10pt;
                color: #000;
            }}
            .container {{
                max-width: 100%;
                padding: 0;
            }}
            pre {{
                background-color: #1e293b !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }}
            .callout-box, .meta-pill, table th {{
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }}
        }}
    </style>
</head>
<body>

<div class="container">

    <!-- কভার পেজ -->
    <div class="cover-page">
        <div class="cover-logo">Z</div>
        <div class="chapter-badge">Zengfy Engineering Standards</div>
        <h1 class="cover-title">Zengfy Sovereign Registration &amp; Identity<br>Engineering Masterclass</h1>
        <p class="cover-subtitle">
            এন্টারপ্রাইজ গ্রেড নিরাপদ, ব্যয়-সাশ্রয়ী (Zero-Cost Verification) এবং সার্বভৌম রেজিস্ট্রেশন সিস্টেম নির্মাণের সম্পূর্ণ হ্যান্ডবুক
        </p>
        
        <div class="cover-meta">
            <span class="meta-pill">📁 পাথ: core/docs/Registration</span>
            <span class="meta-pill">🛡️ রুল: Day 0 Minimalist Flow (৩টি ফিল্ড)</span>
            <span class="meta-pill">⚖️ সাইবার নিরাপত্তা আইন ২০২৩ কমপ্লায়েন্ট</span>
            <span class="meta-pill">📅 সংস্করণ: অক্টোবর ২০২৬</span>
        </div>
    </div>

    <!-- মূল অধ্যায়সমূহ -->
    {all_sections}

</div>

</body>
</html>
'''

    with open(HTML_OUTPUT, "w", encoding="utf-8-sig") as f:
        f.write(html_template)
    
    print(f"Master HTML generated: {HTML_OUTPUT} ({len(html_template)} chars)")
    return HTML_OUTPUT

def print_pdf_via_chrome(html_path):
    print("Initiating Chrome Headless PDF generation...")
    if not os.path.exists(CHROME_PATH):
        raise FileNotFoundError(f"Chrome executable not found at: {CHROME_PATH}")

    cmd = [
        CHROME_PATH,
        "--headless",
        "--disable-gpu",
        "--no-pdf-header-footer",
        "--run-all-compositor-stages-before-draw",
        f"--print-to-pdf={PDF_OUTPUT}",
        html_path
    ]

    result = subprocess.run(cmd, capture_output=True, text=True)
    if result.returncode != 0:
        print(f"Chrome PDF generation failed with code {result.returncode}:")
        print(result.stderr)
        return False
        
    if os.path.exists(PDF_OUTPUT):
        size_kb = os.path.getsize(PDF_OUTPUT) / 1024
        print(f"SUCCESS: Master PDF compiled successfully!")
        print(f"Destination: {PDF_OUTPUT}")
        print(f"File Size: {size_kb:.2f} KB")
        return True
    else:
        print("ERROR: PDF file was not created.")
        return False

if __name__ == "__main__":
    html_file = build_master_html()
    print_pdf_via_chrome(html_file)
