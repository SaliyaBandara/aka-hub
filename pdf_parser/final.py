import sys
import camelot
from pathlib import Path
import json

def process_pdf(filename):
    # filename = "C:\\Files\\www\\aka-hub\\hidden\\pdf_parser\\timetable.pdf"
    file = Path(filename).resolve()
    abc = camelot.read_pdf(str(file), pages='all')
    
    cleaned = []
    columns_to_keep = ['Date', 'Time', 'Year', 'Subject Code', 'Subject Name', 'Venue']
    
    for i in range(len(abc)):
        header = abc[i].df.iloc[0]
        
        for j in range(1, len(abc[i].df)):
            row = abc[i].df.iloc[j]
            values = {}
            for k in range(len(row)):
                if header[k] in columns_to_keep:
                    values[header[k]] = row[k]
            cleaned.append(values)
    
    return json.dumps(cleaned)

if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: python script.py <filename>")
        sys.exit(1)

    filename = sys.argv[1]
    result = process_pdf(filename)
    print(result)
