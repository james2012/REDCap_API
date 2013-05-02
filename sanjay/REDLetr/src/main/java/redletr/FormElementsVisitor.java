package redletr;

import org.json.JSONException;

import java.util.List;
import java.util.Map;

/**
 * @author Sanjay Agravat
 *
 * Visitor interface for converting the data dictionary to a form element.
 */
public interface FormElementsVisitor {

    public Map<String, String> visit(Map<String, List<RedCapDataDictionary>> map) throws JSONException;
}
