function Injector() {
    this.skills = [];
    this.select = [];
    this.queue = [];

    this.total_sp = 0;
    this.injectors = 0;

    this.init();
}

Injector.prototype.init = function () {
    var _this = this;
    $.fn.editable.defaults.mode = 'inline';

    $.getJSON('api/skills', this.bindData.bind(this));

    $('.btn-add').on('click', function () {
        var id = $('#skills').val();
        var skill = _this.findSkillById(id, _this.skills);
        _this.addToQueue(skill);
    });

    Array.observe(this.queue, this.buildQueue.bind(this));
    Array.observe(this.select, this.rebuildSelect.bind(this));
};


Injector.prototype.buildQueue = function (event) {
    var queue = $('.skill-list');
    queue.empty();
    this.updateSelect();
    var _this = this;

    for (var index in this.queue) {
        queue.append('<li class="list-group-item">' + this.queue[index].text + '<span class="pull-right edit-level">Level: <span class="level-' + index + '">' + this.queue[index].level + '</span></span></li>');

        $('.level-' + index).editable({
            type: 'number',
            title: 'Enter Level',
            validate: function (val) {
                if (val < 1 || val > 5)
                    return "Number between 1 and 5 only.";
            },
            success: function (resp, val) {
                _this.queue[index].level = val;
                _this.calcSkillPoints();
                _this.calcInjectors();
            }
        });
    }

    this.calcSkillPoints();
    this.calcInjectors();
};

Injector.prototype.bindData = function (data) {
    this.skills = $.extend(true, [], data);
    this.select = $.extend(true, [], data);

    $('#skills').select2({"data": this.select});

};

Injector.prototype.rebuildSelect = function () {
    $('#skills').select2({"data": this.select});
};

Injector.prototype.addToQueue = function (skill) {
    var _this = this;
    var url = '/api/prereq/' + skill.id;

    skill.level = 1;
    _this.queue.push(skill);

    $.getJSON(url, function (data) {
        if (data.length > 0) {
            for (var i in data) {
                var queueSkill = _this.findSkillById(data[i].id, _this.queue);
                var skill = _this.findSkillById(data[i].id, _this.skills);

                if (queueSkill == null) {
                    skill.level = data[i].req;
                    _this.queue.push(skill)
                } else {
                    if (queueSkill.level < data[i].req) {
                        queueSkill.level = data[i].req;
                    }
                }
            }
        }
    });
};

Injector.prototype.findSkillById = function (id, data) {
    for (var i = 0, len = data.length; i < len; i++) {
        if (data[i].id == id)
            return data[i];
    }

    return null;
};

Injector.prototype.updateSelect = function () {
    var _queue = this.queue;
    for (var skill in this.queue) {
        $('#skills option').each(function () {
            var _this = $(this);
            if (_this.val() == _queue[skill].id) {
                _this.remove();
            }
        });
    }
    $('#skills').trigger('change');

};

Injector.prototype.calcSkillPoints = function () {
    var total = 0;

    for (var i in this.queue) {
        total += 250 * this.queue[i].Multiplier * ( Math.pow(Math.sqrt(32), this.queue[i].level - 1) );
    }

    this.total_sp = total;

    $('.total-sp').text(Math.floor(total).toLocaleString('en-US', {minimumFractionDigits: 0}));
};

Injector.prototype.calcInjectors = function () {
    var injectors = 0;
    var injectorExp = 0;

    while (this.total_sp > injectorExp) {
        if (injectorExp <= 5000000) {
            injectorExp += 500000;
            injectors++;
            continue;
        } else if (injectorExp > 5000000 && injectorExp <= 50000000) {
            injectorExp += 400000;
            injectors++;
            continue;

        } else if (injectorExp > 50000000 && injectorExp <= 80000000) {
            injectorExp += 300000;
            injectors++;
            continue;
        } else if (injectorExp > 80000000) {
            injectorExp += 150000;
            injectors++;
            continue;
        }
    }

    this.injectors = injectors;

    $('.injectors').text(injectors);

};

(function () {
    new Injector();
})();