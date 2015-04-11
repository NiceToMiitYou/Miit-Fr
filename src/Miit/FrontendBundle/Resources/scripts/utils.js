var MiitUtils = (function() {
    // Regex for email
    var RegexEmail    = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

    // Regex for team name
    var RegexTeamName = /^[a-z0-9]{4,}$/i;

    // Generate the validator for a regex
    var validatorGenerator = function(re) {
        // Return the validation function
        return function(value) {
            // Test the regex
            return re.test(value);
        };
    }

    return {
        validator: {
                email: validatorGenerator(RegexEmail),
                team:  validatorGenerator(RegexTeamName)
            }
        };
})();