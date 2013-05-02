package redletr;

/**
 * @author Sanjay Agravat
 *
 Create a data dictionary using the following fields:
 Variable / Field Name
 Form Name
 Section Header
 Field Type
 Field Label
 Choices, Calculations, OR Slider Labels
 Field Note
 Text Validation Type OR Show Slider Number
 Text Validation Min
 Text Validation Max
 Identifier?
 Branching Logic (Show field only if...)
 Required Field?
 Custom Alignment
 Question Number (surveys only)
 *
 */
public class RedCapDataDictionary {

    public static int VARIABLE_NAME = 0;
    public static int FORM_NAME = 1;
    public static int SECTION_HEADER = 2;
    public static int FIELD_TYPE = 3;
    public static int FIELD_LABEL = 4;
    public static int CHOICES_CALC = 5;
    public static int FIELD_NOTE = 6;
    public static int TEXT_VALID_TYPE = 7;
    public static int TEXT_VALID_MIN = 8;
    public static int TEXT_VALID_MAX = 9;
    public static int IS_IDENTIFIER = 10;
    public static int BRANCHING_LOGIC = 11;
    public static int IS_REQUIRED_FIELD = 12;
    public static int CUSTOM_ALIGN = 13;
    public static int QUESTION_NUM = 14;

    private String variableName;
    private String formName;
    private String sectionHeader;
    private String fieldType;
    private String fieldLabel;
    private String choiceCalc;
    private String fieldNote;
    private String validationType;
    private String validationMin;
    private String validationMax;
    private boolean isIdentifier;
    private String branchingLogic;
    private boolean isRequiredField;
    private String customAlignment;
    private String questionNumber;

    public static RedCapDataDictionary createDataDictionary(String ... vars) {

        RedCapDataDictionary dataDictionary = new RedCapDataDictionary();
        dataDictionary.setVariableName(vars[VARIABLE_NAME]);
        dataDictionary.setFormName(vars[FORM_NAME]);
        dataDictionary.setSectionHeader(vars[SECTION_HEADER]);
        dataDictionary.setFieldType(vars[FIELD_TYPE]);
        dataDictionary.setFieldLabel(vars[FIELD_LABEL]);
        dataDictionary.setChoiceCalc(vars[CHOICES_CALC]);
        dataDictionary.setFieldNote(vars[FIELD_NOTE]);
        dataDictionary.setValidationType(vars[TEXT_VALID_TYPE]);
        dataDictionary.setValidationMin(vars[TEXT_VALID_MIN]);
        dataDictionary.setValidationMax(vars[TEXT_VALID_MAX]);
        String isIdentifierStr = vars[IS_IDENTIFIER];

        if (isIdentifierStr != null && isIdentifierStr.equalsIgnoreCase("Y")) {
            dataDictionary.setIdentifier(true);
        } else {
            dataDictionary.setIdentifier(false);
        }

        dataDictionary.setBranchingLogic(vars[BRANCHING_LOGIC]);
        String isRequiredStr = vars[IS_REQUIRED_FIELD];

        if (null != isRequiredStr && isRequiredStr.equalsIgnoreCase("Y")) {
            dataDictionary.setRequiredField(true);
        } else {
            dataDictionary.setRequiredField(false);
        }

        dataDictionary.setCustomAlignment(vars[CUSTOM_ALIGN]);
        dataDictionary.setQuestionNumber(vars[QUESTION_NUM]);

        return dataDictionary;
    }

    public String getVariableName() {
        return variableName;
    }

    public void setVariableName(String variableName) {
        this.variableName = variableName;
    }

    public String getFormName() {
        return formName;
    }

    public void setFormName(String formName) {
        this.formName = formName;
    }

    public String getSectionHeader() {
        return sectionHeader;
    }

    public void setSectionHeader(String sectionHeader) {
        this.sectionHeader = sectionHeader;
    }

    public String getFieldType() {
        return fieldType;
    }

    public void setFieldType(String fieldType) {
        this.fieldType = fieldType;
    }

    public String getFieldLabel() {
        return fieldLabel;
    }

    public void setFieldLabel(String fieldLabel) {
        this.fieldLabel = fieldLabel;
    }

    public String getChoiceCalc() {
        return choiceCalc;
    }

    public void setChoiceCalc(String choiceCalc) {
        this.choiceCalc = choiceCalc;
    }

    public String getFieldNote() {
        return fieldNote;
    }

    public void setFieldNote(String fieldNote) {
        this.fieldNote = fieldNote;
    }

    public String getValidationType() {
        return validationType;
    }

    public void setValidationType(String validationType) {
        this.validationType = validationType;
    }

    public String getValidationMin() {
        return validationMin;
    }

    public void setValidationMin(String validationMin) {
        this.validationMin = validationMin;
    }

    public String getValidationMax() {
        return validationMax;
    }

    public void setValidationMax(String validationMax) {
        this.validationMax = validationMax;
    }

    public boolean isIdentifier() {
        return isIdentifier;
    }

    public void setIdentifier(boolean identifier) {
        isIdentifier = identifier;
    }

    public String getBranchingLogic() {
        return branchingLogic;
    }

    public void setBranchingLogic(String branchingLogic) {
        this.branchingLogic = branchingLogic;
    }

    public boolean isRequiredField() {
        return isRequiredField;
    }

    public void setRequiredField(boolean requiredField) {
        isRequiredField = requiredField;
    }

    public String getCustomAlignment() {
        return customAlignment;
    }

    public void setCustomAlignment(String customAlignment) {
        this.customAlignment = customAlignment;
    }

    public String getQuestionNumber() {
        return questionNumber;
    }

    public void setQuestionNumber(String questionNumber) {
        this.questionNumber = questionNumber;
    }


}
