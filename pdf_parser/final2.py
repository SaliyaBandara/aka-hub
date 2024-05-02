import sys
import camelot
from pathlib import Path
import json
import tabulate

def process_pdf(filename):
    # filename = "C:\\Files\\www\\aka-hub\\hidden\\pdf_parser\\timetable2.pdf"
    file = Path(filename).resolve()
    abc = camelot.read_pdf(str(file), pages='all')
    
    cleaned = []
    columns_to_keep = ['Date', 'Time', 'Year', 'Subject Code', 'Subject Name', 'Venue']
    
    for i in range(len(abc)):
        # print(tabulate.tabulate(abc[i].df, headers='keys', tablefmt='psql'))
        # continue
        header = abc[i].df.iloc[0]
        
        for j in range(1, len(abc[i].df)):
            row = abc[i].df.iloc[j]
            # print(row)
            values = {}
            for k in range(len(row)):
                # if Venue is not present in the header check if any header with substring Venue is present
                if('Exam' in header[k]):
                    values["Venue"] = row[k]
                    # print(row)
                    # print(row[k])
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
