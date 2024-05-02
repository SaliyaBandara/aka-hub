import sys
import camelot
from pathlib import Path
import json
import tabulate

def process_pdf(filename):
    # filename = "C:\\Files\\www\\aka-hub\\hidden\\pdf_parser\\timetable2.pdf"
    file = Path(filename).resolve()
    parsed = camelot.read_pdf(str(file), pages='all')
    
    cleaned = []
    columns_to_keep = ['Date', 'Time', 'Year', 'Subject Code', 'Subject Name', 'Venue']
    
    for i in range(len(parsed)):
        # print(tabulate.tabulate(parsed[i].df, headers='keys', tablefmt='psql'))
        # continue
        header = parsed[i].df.iloc[0]
        
        for j in range(1, len(parsed[i].df)):
            row = parsed[i].df.iloc[j]
            # print(row)
            values = {}
            for k in range(len(row)):
                # if Venue is not present in the header check if any header with substring Venue is present
                if('Exam' in header[k]):
                    values["Venue"] = row[k]
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
