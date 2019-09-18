Task Scheduler
---

---

[What is the task scheduler?](#what-is-the-task-scheduler)

[How do I set the task scheduler up?](#how-do-i-set-the-task-scheduler-up)

---

<a id="what-is-the-task-scheduler"></a>
### What is the task scheduler?

The task scheduler is a crucial cron job responsible for all of the
automatic processes from within BillingTrack. Some of these processes
include:

-   Sending overdue notices
-   Generating recurring invoices

These processes will not function unless the task scheduler cron job has
been created.

---

<a id="how-do-i-set-the-task-scheduler-up"></a>
### How do I set the task scheduler up?

The cron job for the task scheduler should be set up to run once per
day. Below is an example of how to create the cron job from an SSH
command line to run the task scheduler every morning at 3am (change the
hour as needed).

1.  From an SSH command line, enter the following command:
    `crontab -e`
2.  When in the crontab editor, enter the following command and save the
    file:
    `0 3 * * * curl http://YourBillingTrackURL/tasks/run >> /dev/null 2>&1`

If you do not have SSH access and you use Godaddy or a similar company,
you should have some type of account control panel from which cron jobs
can be created. If this is the case but you are unsure of how to
navigate the control panel to create the cron job then you will need to
contact your web host or system administrator for assistance.
