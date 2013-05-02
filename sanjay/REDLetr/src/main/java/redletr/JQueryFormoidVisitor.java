package redletr;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.List;
import java.util.Map;

/**
 * @author Sanjay Agravat
 *
 * JQueryFormoidVisitor implementation.
 *
 */
public class JQueryFormoidVisitor implements FormElementsVisitor {

    @Override
    public Map<String, String> visit(Map<String, List<RedCapDataDictionary>> map) throws JSONException {
        Map<String, String> transformation = new HashMap<String, String>();

        for (String formName : map.keySet()) {
            JSONArray array = new JSONArray();

            List<RedCapDataDictionary> dataDictionaryList = map.get(formName);
            for (RedCapDataDictionary dataDictionary : dataDictionaryList) {
                JSONObject jsonObject = new JSONObject();
                jsonObject.put("name", dataDictionary.getVariableName());
                jsonObject.put("id", dataDictionary.getVariableName());
                jsonObject.put("label", dataDictionary.getFieldLabel());
                jsonObject.put("hover", "");
                String fieldType = dataDictionary.getFieldType();

                if (fieldType.equals("checkbox")) {
                    String choices = dataDictionary.getChoiceCalc();
                    String [] splits = choices.split("\\|");
                    JSONArray arrayItems = new JSONArray();
                    for (String item : splits) {
                        String [] questionItem = item.split(",");
                        arrayItems.put(questionItem[1].trim());
                    }
                    jsonObject.put("items", arrayItems);

                    jsonObject.put("type", "checkbox");
                }
                else if (fieldType.equals("descriptive")) {
                    jsonObject.put("type", "textarea");
                }
                else if (fieldType.equals("dropdown")) {
                    String choices = dataDictionary.getChoiceCalc();
                    String [] splits = choices.split("\\|");
                    JSONArray arrayItems = new JSONArray();
                    for (String item : splits) {
                        String [] questionItem = item.split(",");
                        arrayItems.put(questionItem[1].trim());
                    }
                    jsonObject.put("items", arrayItems);
                    jsonObject.put("type", "select");
                }
                else if (fieldType.equals("file")) {
                    jsonObject.put("type", "file");
                }
                else if (fieldType.equals("notes")) {
                    jsonObject.put("type", "textarea");
                }
                else if (fieldType.equals("radio")) {
                    String choices = dataDictionary.getChoiceCalc();
                    String [] splits = choices.split("\\|");
                    JSONArray arrayItems = new JSONArray();
                    for (String item : splits) {
                        String [] questionItem = item.split(",");
                        arrayItems.put(questionItem[1].trim());
                    }
                    jsonObject.put("items", arrayItems);
                    jsonObject.put("type", "radio");
                }
                else if (fieldType.equals("text")) {
                    jsonObject.put("type", "input");
                }
                else if (fieldType.equals("yesno")) {
                    jsonObject.put("type", "radio");
                    String choices = dataDictionary.getChoiceCalc();
                    String [] splits = choices.split("\\|");
                    JSONArray arrayItems = new JSONArray();
                    arrayItems.put("yes");
                    arrayItems.put("no");
                    jsonObject.put("items", arrayItems);

                }
                array.put(jsonObject);
            }
            JSONObject elements = new JSONObject();
            elements.put("elements", array);

            transformation.put(formName, elements.toString());
        }
        return transformation;
    }
}
