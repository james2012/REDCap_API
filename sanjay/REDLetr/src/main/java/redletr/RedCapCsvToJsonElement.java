package redletr;

import au.com.bytecode.opencsv.CSVReader;
import org.json.JSONException;

import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Map;


/**
 * @author Sanjay Agravat
 *
 * Quick and dirty hack to convert a RedCap CSV Data Dictionary to a JSON Object to be used
 * as form elements.
 *
 */
public class RedCapCsvToJsonElement {

    public Map<String, String> convert(Map<String, List<RedCapDataDictionary>> map, FormElementsVisitor visitor) throws JSONException {

        Map<String, String> transformation = visitor.visit(map);
        return transformation;

    }

    public static void main(String[] args) throws Exception {


        String filename = args[0];
        if (args.length > 0) {
            File f = new File(filename);
            if (!f.exists() || !f.canRead()) {
                System.out.println("file does not exist or cannot read file: " + filename);
                System.exit(1);
            }

        } else {
            System.out.println("Please pass the filename as a program argument.");
        }

        CSVReader reader = new CSVReader(new FileReader(filename));

        List<String[]> strings = reader.readAll();
        Map<String, List<RedCapDataDictionary>> map = new HashMap<String, List<RedCapDataDictionary>>();

        for (int i = 1; i < strings.size(); i++) {
            String [] row = strings.get(i);
            String form = row[RedCapDataDictionary.FORM_NAME];
            if (!map.containsKey(form)) {
                RedCapDataDictionary dataDictionary = RedCapDataDictionary.createDataDictionary(row);
                List<RedCapDataDictionary> dataDictionaryList = new ArrayList<RedCapDataDictionary>();
                dataDictionaryList.add(dataDictionary);
                map.put(form, dataDictionaryList);
            } else {
                List<RedCapDataDictionary> dataDictionaryList = map.get(form);
                RedCapDataDictionary dataDictionary = RedCapDataDictionary.createDataDictionary(row);
                dataDictionaryList.add(dataDictionary);
            }
        }
        reader.close();
        RedCapCsvToJsonElement redCapCsvToJsonElement = new RedCapCsvToJsonElement();
        Map<String, String> transformation = redCapCsvToJsonElement.convert(map, new JQueryFormoidVisitor());
        for (String form : transformation.keySet()) {
            System.out.println(form + " " + transformation.get(form));
            FileWriter fw = new FileWriter(new File("/tmp/"+form+".formoid"));
            fw.write(transformation.get(form));
            fw.close();
        }


    }

}
