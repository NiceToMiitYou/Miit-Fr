(function(){
    var MiitUtils = injector.resolve(function() {
        /**
         * Validator part
         */

        // Regex for email
        var RegexEmail    = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;

        // Regex for team name
        var RegexTeamName = /^[a-z0-9]{4,}$/i;

        // Regex for password
        var RegexPassword = /^.{6,32}$/;

        // Generate the validator for a regex
        var validatorGenerator = function(re) {
            // Return the validation function
            return function(value) {
                // Test the regex
                return re.test(value);
            };
        };

        // Generate the validator for user's role
        var isUserGenerator = function(role) {
            return function(user) {
                if(!user) {
                    user = MiitApp.storage.shared.get('user');
                }

                return user.roles.indexOf(role) >= 0
            };
        };

        // Check if this is the same user
        var isItMe = function(user) {
            var me  = (MiitApp.storage.shared.get('user') || {}).id || null;
            var you = (user || {}).id || null;

            return me === you;
        };

        /**
         * Ajax part
         */

        // get the list of HttpRequestHandlers
        var XMLHttpFactories = [
            function () {return new XMLHttpRequest()},
            function () {return new ActiveXObject('Msxml2.XMLHTTP')},
            function () {return new ActiveXObject('Msxml3.XMLHTTP')},
            function () {return new ActiveXObject('Microsoft.XMLHTTP')}
        ];

        // Generator of HttpRequestHandler
        function createXMLHTTPObject() {
            var xmlhttp = false;
            for (var i=0;i<XMLHttpFactories.length;i++) {
                try {
                    xmlhttp = XMLHttpFactories[i]();
                }
                catch (e) {
                    continue;
                }
                break;
            }
            return xmlhttp;
        }

        // Send request method
        var sendRequest = function(url, postData, cb) {
            var req = createXMLHTTPObject();

            if(!req) return;

            if(typeof postData === 'function') {
                cb       = postData;
                postData = null;
            }
            
            var method = (postData) ? 'POST' : 'GET';
            
            req.open(method, url, true);
            
            if(postData) {
                req.setRequestHeader('Content-type','application/json');
            }

            req.onreadystatechange = function () {
                if (req.readyState != 4) return;
                if (req.status != 200 && req.status != 304) {
                    return;
                }

                var result;

                try {
                    result = JSON.parse(req.responseText);
                } catch(e) { }

                if(typeof cb === 'function') {
                    cb(result);
                }
            };
            
            if (req.readyState == 4) return;

            req.send(JSON.stringify(postData));
        }

        // Get CRSF token to validate Form.
        var getCrsf = function(intention, cb) {
            if(typeof intention === 'function') {
                cb        = intention;
                intention = null;
            }

            var url = '/_crsftoken/' + (intention || '');

            sendRequest(url, function(data) {
                if(data       &&
                   data.token &&
                   typeof cb === 'function') {

                    cb(data.token);
                }
            });
        }

        // Return the public object
        return {
            ajax: {
                send: sendRequest,
                crsf: getCrsf
            },

            user: {
                isAdmin: isUserGenerator('ADMIN'),
                isUser:  isUserGenerator('USER'),
                isOwner: isUserGenerator('OWNER'),
                isItMe:  isItMe,
            },

            validator: {
                email:    validatorGenerator(RegexEmail),
                password: validatorGenerator(RegexPassword),
                team:     validatorGenerator(RegexTeamName)
            }
        };
    });

    injector.register('miit-utils', MiitUtils);
})();